<?php

namespace App\Http\Livewire;

use App\Models\Shoe;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;
class Shoes extends Component
{
    use WithPagination;
    use WithFileUploads;
    
    public $name, $price,$size,$image, $quantity;
   

    
    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload($imageData)
    {
       $this->image = $imageData;
  
    }
    


    
//    public function removeAnnouncement($announcementID)
//    {
//         $removeAnn = Shoe::find($announcementID);
//         $removeAnn->delete();
        
//         session()->flash('rmmessage', 'Announcement successfully Deleted.');
      
    
//    }

   

public function addShoes()
{

    $image = $this->storeImage();
  Shoe::create([   
    'name' => $this->name,
    'price' => $this->price,
    'size' => $this->size,
   'quantity' => $this->quantity,
   'image' => $image
    
  ]);
    $this->name = "";
    $this->price = "";
    $this->size ="";
    $this->image ="";   
    $this->quantity = "";
 
    session()->flash('message', 'Announcement successfully Added.');

} 
public function storeImage()
{

    if(!$this->image){
        return null;
    }
    $img = Image::make($this->image)->encode('jpg');
    $name = Str::random(). '.jpg';
    Storage::disk('public')->put($name,$img);
    return $name;
}

 
    public function render()
    {
        return view('livewire.shoes', [
            'shoesData' => Shoe::all()
        ]);
    }
}
