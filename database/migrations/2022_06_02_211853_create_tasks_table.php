<?php

use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('priority', [Task::PRIORITY_HIGH, Task::PRIORITY_LOW, Task::PRIORITY_MEDIUM]);
            $table->enum('state', [Task::STATE_OPEN, Task::STATE_CLOSE, Task::STATE_REJECTED, Task::STATE_TO_DO, Task::STATE_IN_PROGRESS, Task::STATE_TESTING, Task::STATE_DONE]);
            $table->datetime('due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
