<?php namespace App\Http\Requests\Kependudukan;

use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class PribadiRincianFormRequest extends Request
{
    /**
     * @var array
     */
    protected $attrs = [
        'nik'            => 'NIK',
        'kelainan_fisik' => 'Kelainan Fisik',
        'cacat_fisik'    => 'Cacat Fisik',
        'warga_negara'   => 'Warga Negara',
        'website'        => 'Website',
        'email'          => 'Email',
        'telp'           => 'Telepon',
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik'            => 'required|max:16|unique:pribadi_rincian,nik',
            'kelainan_fisik' => 'max:100',
            'cacat_fisik'    => 'max:100',
            'warga_negara'   => 'required|max:30',
            'website'        => 'max:80|url',
            'email'          => 'max:80|email',
            'telp'           => 'max:15',
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
                'nik'            => $message->first('nik'),
                'kelainan_fisik' => $message->first('kelainan_fisik'),
                'cacat_fisik'    => $message->first('cacat_fisik'),
                'warga_negara'   => $message->first('warga_negara'),
                'website'        => $message->first('website'),
                'email'          => $message->first('email'),
                'telp'           => $message->first('telp'),
            ]
        ];
    }
}
