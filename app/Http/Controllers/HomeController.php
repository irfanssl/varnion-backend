<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RandomUser;
use App\Models\HasilResponse;
use App\Models\Profesi;
use Illuminate\Support\Arr;
use Laravel\Prompts\Prompt;
use stdClass;

class HomeController extends Controller
{
    /**
     * @return json random user
     */
    public function randomUser(){
        $randomUser = new RandomUser();
        $randomUser = $randomUser->get();
        return $randomUser;
    }

    /**
     *  @return \Illuminate\Http\Response
     */
    public function saveRandomUser(){
        $randomUser = $this->randomUser();
        if($randomUser->results[0]){
            $profesi = collect(Profesi::select('id')->get())->pluck('id')->toArray(); // [1,2,3,4,...]
            // dd($profesi);
            $result = $randomUser->results[0];
            $hasilResponse = new HasilResponse();
            $hasilResponse->jenis_kelamin = $result->gender === 'female' ? 2 : 1;
            $hasilResponse->nama = $result->name->first.' '.$result->name->last;
            $hasilResponse->nama_jalan = $result->location->street->name;
            $hasilResponse->email = $result->email;
    
            // counter angka kurang dari / lebih dari 7 yg berasal dari hashing nmd5
            $md5 = $result->login->md5;
            $angkaKurangDari7 = strlen(preg_replace( '/[^0-7]/', '', $md5));
            $angkaLebihDari7 = strlen(preg_replace( '/[^8-9]/', '', $md5));
            // $angka = preg_replace( '/[^0-9]/', '', $md5);
            // dd( $angkaKurangDari7, $angkaLebihDari7, $angka, $result);
    
            $hasilResponse->angka_kurang =  $angkaKurangDari7;
            $hasilResponse->angka_lebih =  $angkaLebihDari7;
            $hasilResponse->profesi = Arr::random($profesi);
            // dd(Arr::random($profesi));
            $hasilResponse->plain_json = json_encode($randomUser);
            $hasilResponse->saveOrFail();

            return response()
                    ->json([
                        'code'      => 200,
                        'message'   => 'success',
                        'data'      => $hasilResponse
                    ], 200);
        }
    }

    /**
     * @return array hasil response
     */
    public function getRandomUser(){
        $users = HasilResponse::with('namaProfesi')
                            ->select('id', 'nama', 'jenis_kelamin', 'nama_jalan', 'email', 'profesi', 'plain_json')   
                            ->get();
        // dd(json_decode($users[0]->plain_json)->results[0]->login->uuid);
        $result = [];
        foreach($users as $key => $user){
            // dd($user);
            $uuid = json_decode($user->plain_json)->results[0]->login->uuid;
            $object = new stdClass;
            $object->nomor = $user->id;
            $object->nama = $user->nama;
            $object->jenis_kelamin = $user->jenis_kelamin;
            $object->jalan = $user->nama_jalan;
            $object->email = $user->email;
            $object->profesi = $user->namaProfesi->profesi;
            $object->uuid = $uuid;
            $object->angka = preg_replace( '/[^0-9]/', '', $uuid);
            $object->huruf = preg_replace( '/[^a-zA-Z]/', '', $uuid);
            $result[] = $object;
        }
        // dd($result);
        return $result;
    }

    /**
     * @return array hasil perhitungan profesi seluruh user
     */
    public function getProfesi(){
        $profesi = Profesi::with('users.jk')->get();
        $result = [];
        $pria = 0;
        $perempuan = 0;
        foreach($profesi as $pro){
            $object = new stdClass;
            // dd($pro);
            foreach($pro->users as $user){
                $user->jk->kelamin === 'Laki - laki' ? $pria++ : $perempuan++;
            }
            $jenis_kelamin = [
                'pria' => $pria,
                'wanita' => $perempuan
            ];
            $object->nomor = $pro->id;
            $object->profesi = $pro->profesi;
            $object->jumlah = $pro->users->count();
            $object->ringkasan = $jenis_kelamin;
            $pria = 0;
            $perempuan = 0;
            $result[] = $object;
            // dd($object);
        }
        return $result;
    }
}
