<?php
namespace App\Modules\Models;
use App\Modules\Models\BaseModel;
use Carbon\Carbon;
use DateTime;
use function PHPSTORM_META\map;

class User extends BaseModel
{
    public string $email;
    public string $password;
    public bool $is_locked;
    public bool $is_admin;
    public DateTime $created_at;
    public DateTime $updated_at;
    /**
     * Setta gli attributi che formano il modello
     * 
     * @return array
     */
    protected function getAttributes(): array
    {
        return [
            'email',
            'password',
            'is_locked',
            'is_admin',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Costruisce l'istanza della classe
     */
    public function __construct(string $email = "", string $password = "", bool $is_locked = false, bool $is_admin = false)
    {
        $this->email = $email;
        $this->password = $password;
        $this->is_locked = $is_locked;
        $this->is_admin = $is_admin;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }
}
