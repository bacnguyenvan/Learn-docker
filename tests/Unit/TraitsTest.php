<?php

namespace Tests\Unit;

use App\Traits\GetDummyData;
use App\Traits\ResponseAPI;
use App\Traits\UploadFileAPI;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\UnitCase;

class TraitsTest extends UnitCase
{
    use ResponseAPI, UploadFileAPI, GetDummyData;

    public function setUp(): void
    {
        parent::setUp();
        $data = '[
            {
                "id" : 1,
                "name" : "トレッキング"
            }
        ]';
        Storage::disk('public_uploads')->put('testDummy/test.json', $data);
    }

    public function test_can_show_success_json()
    {
        $response = $this->success('test success', [
            'result' => 'OK'
        ], 200);

        $this->assertTrue($response->getData()->status_code == 200);
        $this->assertTrue($response->getData()->message == 'test success');
        $this->assertTrue($response->getData()->data->result == 'OK');
    }

    public function test_can_show_error_json()
    {
        $response = $this->error('test fail', [
            'error' => 'error'
        ], 401);

        $this->assertTrue($response->getData()->status_code == 401);
        $this->assertTrue($response->getData()->message == 'test fail');
        $this->assertTrue($response->getData()->errors->error == 'error');
    }

    public function test_can_upload_file()
    {
        $file = UploadedFile::fake()->image(public_path('images/avatar.jpg'));
        $response = $this->upload($file, 'stamp_imgs');

        $this->assertFileExists('public/' . implode('/', array_slice(explode('/', $response), 3)));
    }

    public function test_can_get_dummy_data()
    {
        $dataTest = $this->dummyData(public_path() . '/uploads/testDummy/test.json');

        $this->assertTrue($dataTest[0]->id == 1);
        $this->assertTrue($dataTest[0]->name == 'トレッキング');
    }
}
