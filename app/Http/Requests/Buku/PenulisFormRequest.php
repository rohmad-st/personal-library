<?php namespace App\Http\Requests\Buku;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PenulisFormRequest extends Request
{

    /**
     * @var array
     */
    protected $attrs = [
        'nama'          => 'Nama',
        'tempat_lahir'  => 'Tempat Lahir',
        'tanggal_lahir' => 'Tanggal Lahir',
        'alamat'        => 'Alamat',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'          => 'required|max:50',
            'tempat_lahir'  => 'max:50',
            'tanggal_lahir' => 'max:10',
            'alamat'        => 'max:100',
        ];
    }

    /**
     * @param $validator
     *
     * @return mixed
     */
    public function validator($validator)
    {
        return $validator->make($this->all(), $this->container->call([$this, 'rules']), $this->messages(), $this->attrs);
    }

    /**
     * @param Validator $validator
     *
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $message = $validator->errors();

        return [
            'success'    => false,
            'validation' => [
                'nama'          => $message->first('nama'),
                'tempat_lahir'  => $message->first('tempat_lahir'),
                'tanggal_lahir' => $message->first('tanggal_lahir'),
                'alamat'        => $message->first('alamat'),
            ]
        ];
    }
}
