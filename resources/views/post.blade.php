Halaman Uji Coba Post 
<form method="POST" action="{{route('tasks.store')}}">
    @csrf 
    Umur:
    <input type="text" name="umur"> 
    Nama:
    <input type="text" name="nama">
    <button type="submit">Submit</button>

</form>