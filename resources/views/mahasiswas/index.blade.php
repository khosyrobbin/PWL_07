@extends('mahasiswas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btnsuccess" href="{{route('mahasiswa.create')}}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    @if ($message=Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
   @endif

   <table class="table table-bordered">
       <tr>
           <th>Nim</th>
           <th>Nama</th>
           <th>Kelas</th>
           <th>Jurusan</th>
           <th>No_Handphone</th>
           <th>Email</th>
           <th>Tanggal_Lahir</th>
           <th width="280px">Action</th>
        </tr>

        @foreach ($mahasiswas as $Mahasiswa)
            <tr>
                <td>{{$Mahasiswa->nim}}</td>
                <td>{{$Mahasiswa->nama}}</td> 
                <td>{{$Mahasiswa->kelas->nama_kelas}}</td>
                <td>{{$Mahasiswa->jurusan}}</td>
                <td>{{$Mahasiswa->no_handphone}}</td>
                <td>{{$Mahasiswa->email}}</td>
                <td>{{$Mahasiswa->tanggal_lahir}}</td>
                <td> 
                    <form action="{{route('mahasiswa.destroy',$Mahasiswa->nim)}}" method="POST">
                        <a class="btn btninfo" href="{{route('mahasiswa.show',$Mahasiswa->nim)}}">Show</a>
                        <a class="btn btnprimary" href="{{route('mahasiswa.edit',$Mahasiswa->nim)}}">Edit</a>
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <br/>
    Halaman : {{ $mahasiswas->currentPage() }} <br/>
    Jumlah Data : {{ $mahasiswas->total() }} <br/>
    Data perhalaman : {{ $mahasiswas->perPage() }} <br/>
    <br>
    {{$mahasiswas->links()}} 
@endsection 