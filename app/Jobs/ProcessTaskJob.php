<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 5;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Task $task
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Update status to processing
        $this->task->update([
            'status' => 'processing',
            'progress' => 0,
        ]);

        // Simulate work with progress updates
        for ($i = 1; $i <= 5; $i++) {
            sleep(2);

            $this->task->update([
                'progress' => $i * 20,
            ]);
        }

        // Mark as completed
        $this->task->update([
            'status' => 'completed',
            'progress' => 100,
            'result' => 'Task processed successfully at ' . now()->toDateTimeString(),
            'processed_at' => now(),
        ]);
    }

    /**
     * Handle job failure.
     */
    public function failed(\Throwable $exception): void
    {
        $this->task->update([
            'status' => 'failed',
            'result' => 'Error: ' . $exception->getMessage(),
        ]);
    }
}