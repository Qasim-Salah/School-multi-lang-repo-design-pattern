<?php

namespace App\Providers;

use App\Http\Interfaces\AttendanceRepositoryInterface;
use App\Http\Interfaces\ClassRepositoryInterface;
use App\Http\Interfaces\FeesInvoicesRepositoryInterface;
use App\Http\Interfaces\FeesRepositoryInterface;
use App\Http\Interfaces\GradeRepositoryInterface;
use App\Http\Interfaces\PaymentRepositoryInterface;
use App\Http\Interfaces\ProcessingFeeRepositoryInterface;
use App\Http\Interfaces\ReceiptStudentsRepositoryInterface;
use App\Http\Interfaces\SectionRepositoryInterface;
use App\Http\Interfaces\StudentGraduatedRepositoryInterface;
use App\Http\Interfaces\StudentPromotionRepositoryInterface;
use App\Http\Interfaces\StudentRepositoryInterface;
use App\Http\Interfaces\TeacherRepositoryInterface;
use App\Repository\AttendanceRepository;
use App\Repository\ClassRepository;
use App\Repository\FeesInvoicesRepository;
use App\Repository\FeesRepository;
use App\Repository\GradeRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProcessingFeeRepository;
use App\Repository\ReceiptStudentRepository;
use App\Repository\SectionRepository;
use App\Repository\StudentGraduatedRepository;
use App\Repository\StudentPromotionRepository;
use App\Repository\StudentRepository;
use App\Repository\TeacherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GradeRepositoryInterface::class, GradeRepository::class);

        $this->app->bind(ClassRepositoryInterface::class, ClassRepository::class);

        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);

        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);

        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);

        $this->app->bind(StudentPromotionRepositoryInterface::class, StudentPromotionRepository::class);

        $this->app->bind(StudentGraduatedRepositoryInterface::class, StudentGraduatedRepository::class);

        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);

        $this->app->bind(FeesInvoicesRepositoryInterface::class, FeesInvoicesRepository::class);

        $this->app->bind(ReceiptStudentsRepositoryInterface::class, ReceiptStudentRepository::class);

        $this->app->bind(ProcessingFeeRepositoryInterface::class, ProcessingFeeRepository::class);

        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
