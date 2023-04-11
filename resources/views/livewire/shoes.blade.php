<div>
    <div class="w-full px-40 py-10 text-white bg-red-800 flex justify-between items-center">

        {{-- logo --}}
    <div>
        <img class="w-80" src="{{ asset("img/modern_walk-removebg-preview.png") }}" alt="">
    </div>

    {{-- form --}}

    <form class="flex flex-col p-10 bg-red-900 rounded-md shadow-1xl" wire:submit.prevent="addShoes" action="">

        @csrf
        {{-- top form --}}
        <div class="flex gap-10">

        <div class="flex flex-col gap-2 ">
        <label for="name">Shoe Name</label>
        <input wire:model="name"  class="py-2 px-3 text-slate-900"  class="bg-slate-400" id="name" type="text" placeholder="enter name">
        </div>

        <div class="flex flex-col gap-2 w-40">
        <label for="price">Shoe Price</label>
        <input wire:model="price" class="py-2 px-3 text-slate-900" id="price" type="number" placeholder="enter price">
        </div>

        </div>

        {{-- bottom form --}}
        <div class="flex gap-10"> 
        <div class="flex flex-col gap-2 mt-10">
        <label for="size">Shoe Size</label>
        <select wire:model="size" class="py-2 px-3 text-slate-900" name="size" id="size">
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
        </select>
        </div>


        <div class="flex flex-col gap-2 mt-10 w-40">
            <label for="quatity">Number of Shoes</label>
            <input wire:model="quantity" class="py-2 px-3 text-slate-900" id="quantity" type="number" placeholder="enter quantity">
            </div>

        
    </div>

    <div class="flex flex-col gap-2 mt-10">
        <label for="picture">Shoe Image</label>
        <input wire:change="$emit('fileChoosen')" class="py-2 px-3  text-white" id="image" type="file" placeholder="enter image">
    </div>
    <img class="w-40" src="{{ $image }}" alt="">
 
     
    
    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded font-bold mt-5">Add Shoe</button>
    </form>

</div>
{{-- table --}}

<div class="p-20 flex items-center justify-center gap-10">
    @foreach ($shoesData as $value )
     
    
    <div class="w-72 bg-slate-900 gap-2 text-white items-center justify-center p-10 rounded shadow-lg flex flex-col">
    

    <img src="{{ 'storage/'.$value->image}}" alt="">
        <h1 >{{ $value->name }}</h1>
    <h1 class="text-4xl font-bold ">${{ $value->price }}.00</h1>
    <h1 class="mt-6"><strong>size: </strong>{{ $value->size }}</h1>
    <h1><strong>Stocks Available:</strong> {{ $value->quantity }}</h1>
    </div>
    @endforeach

    
</div>



</div>


<script>
 
 
    Livewire.on('fileChoosen', () => {
        
                 let inputField = document.getElementById('image');
                 let file = inputField.files[0];
                 let reader = new FileReader();
     
                 reader.onloadend = () =>{
                   Livewire.emit('fileUpload',reader.result)
                 }
     
                 reader.readAsDataURL(file);
                 
             })
   
   </script>
