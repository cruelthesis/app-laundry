@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Update Pegawai</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/user/update/'.$user->id) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $user->nama }}" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $user->username }}" name="username">
                </div>
                <div class="mb-3">
                    <label for="">Outlet</label><br>
                    <select class="form-select form-control " id="exampleSelect" name="idoutlet" >
                    @foreach ($outlet as $outlet)
                        <option @selected($outlet->idoutlet==$user->idoutlet) value="{{ $outlet->idoutlet }} " name="idoutlet">{{ $outlet->namaoutlet }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Role</label><br>
                    <select class="form-select form-control " id="exampleSelect"  name="role" >
                        <option value="{{ $user->role }}">{{ $user->role }}</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="" name="password">
                </div>
                

                <button class="btn btn-primary mb-4">Simpan</button>
            </form>


                
            
        </div>
    </div>
</div>

@endsection