<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InterventionImage;

class ViewTrainerProfile extends Model
{
    use HasFactory;

    public function edit_image($profile_image)
    {
        $file_hash_id = hash("sha256", uniqid(rand(), true));
        $extension = $profile_image->getClientOriginalExtension();
        $file_name_trainer_image = $file_hash_id.'.'.$extension;
            InterventionImage::make($profile_image)
                            ->resize(1080, null, function ($constraint){$constraint->aspectRatio();})
                            ->save('storage/trainer/'.$file_name_trainer_image);
            
        $path = 'storage/trainer/'.$file_hash_id.'.'.$extension;

        return $path;
    }
}
