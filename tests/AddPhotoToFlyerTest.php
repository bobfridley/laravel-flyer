<?php

namespace App;

use App\AddPhotoToFlyer;
use Illuminate\Http\UploadedFile;
use Mockery as m;

class AddPhotoToFlyerTest extends \TestCase
{
    /** @test */
    public function it_processes_a_form_to_add_a_photo_to_a_flyer()
    {
        $flyer = factory(Flyer::class)->create();

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo',
            'getClientOriginalExtension' => 'jpg'
        ]);

        $file->shouldReceive('move')
            ->once()
            ->with('images/flyers', 'nowfoo.jpg');

        $thumbnail = m::mock(Thumbnail::class);

        $thumbnail->shouldReceive('make')
            ->once()
            ->with('images/flyers/nowfoo.jpg', 'images/flyers/tn-nowfoo.jpg');

        (new AddPhotoToFlyer($flyer, $file, $thumbnail))->save();

        $this->assertCount(1, $flyer->photos);
    }
}

// mock the built-in functions
function time()
{
    return 'now';
}

function sha1($path)
{
    return $path;
}