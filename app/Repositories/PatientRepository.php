<?php

namespace App\Repositories;

use App\Services\Role;
use App\User;
use Illuminate\Support\Collection;
use function foo\func;

class PatientRepository extends UserRepository
{
    /**
     * PatientRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function query()
    {
        return $this->getUserModel()
            ->where('role_id', Role::PATIENT_ID);
    }

    /**
     * @param string $phoneNumber
     * @return User|null
     */
    public function getByPhone( string $phoneNumber ): ?User
    {
        return $this->query()
            ->where('phone', $phoneNumber)
            ->first();
    }


    /**
     * @param int $doctorId
     * @param bool $isAccepted
     * @return mixed
     */
    public function getPatientsByDoctorId(int $doctorId, bool $isAccepted = false)
    {
        return $this->query()
            ->whereHas('patients', function ($q) use ($doctorId, $isAccepted) {
                $q->where('doctor_id', $doctorId);

                if( $isAccepted ) {
                    $q->whereNotNull('accepted_at');
                }
            })
            ->get();
    }
}
