@extends('client.layouts.app')

@section('title', 'Biên bản Sinh hoạt chủ nhiệm')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/client/css/khungdaotao.css') }}">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Danh sách biên bản sinh hoạt chủ nhiệm</h3>
                </div>
                
                <!-- Curriculum Grid -->
                <div class="curriculum-grid" id="curriculumGrid">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Tên biên bản</th>
                                    <th>Tuần</th>
                                    <th>Giáo viên chủ nhiệm</th>
                                    <th>Thư ký</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bienBanSHCN as $bienBan)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $bienBan->tieu_de }}</td>
                                        <td>Tuần {{ $bienBan->tuan->tuan }}</td>
                                        <td>{{ $bienBan->gvcn->hoSo->ho_ten }}</td>
                                        <td>{{ $bienBan->thuky->hoSo->ho_ten }}</td>
                                        <td><a href="{{ route('sinhvien.bienbanshcn.show', $bienBan) }}" class="btn btn-primary" target="_blank">Xem</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    
                </div>
            </div>
        </div>

    </div>

@endsection