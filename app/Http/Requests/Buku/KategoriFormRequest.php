<?php namespace App\Http\Requests\Buku;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class KategoriFormRequest extends Request
{

    /**
     * @var array
     */
    protected $attrs = [
        'nama'       => 'Nama',
        'keterangan' => 'Keterangan',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'       => 'required|max:50',
            'keterangan' => 'max:225',
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
                'nama'       => $message->first('nama'),
                'keterangan' => $message->first('keterangan'),
            ]
        ];
    }
}
