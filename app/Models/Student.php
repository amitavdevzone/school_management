<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'student_id', 'address_1', 'address_2', 'standard_id', 'vitals', 'dob'
    ];

    protected $casts = [
        'vitals' => 'json'
    ];

    /**
     * @return BelongsTo
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class);
    }

    /**
     * @return BelongsToMany
     */
    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(Guardian::class);
    }

    /**
     * @return HasMany
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(CertificateStudent::class);
    }

    protected function dob(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->age
        );
    }
}
