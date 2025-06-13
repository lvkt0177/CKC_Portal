<?php

namespace App\Repositories\ThongBao;

use App\Repositories\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\ThongBao;
use App\Models\File;
use App\Repositories\ThongBao\ThongBaoRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * The repository for Permission Model
 */
class ThongBaoRepository extends BaseRepository implements ThongBaoRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected $model;

    /**
     * @inheritdoc
     */
    public function __construct(ThongBao $model)
    {
        $this->model = $model;
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->with('giangVien.hoSo')->where('id_gv', auth()->user()->id)->orderBy('ngay_gui', 'desc')->get();
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();

            $files = $data['files'] ?? null;
            unset($data['files']);

            $data['id_gv'] = auth()->user()->id;
            $thongBao = $this->model->create($data);

            if ($files && is_array($files)) {
                foreach ($files as $file) {
                    $path = $file->store('uploads/thongbao','public');

                    File::create([
                        'id_thong_bao' => $thongBao->id,
                        'ten_file'     => $file->getClientOriginalName(),
                        'url'          => $path,
                    ]);
                }
            }

            DB::commit();
            return $thongBao; 

        } catch (\Exception $e) {
            DB::rollBack(); 
            throw $e;
        }
    }

    public function update($model, $data)
    {
        try {
            DB::beginTransaction();

            $files = $data['files'] ?? null;
            unset($data['files']);

            $model->update($data);

            if ($files && is_array($files)) {
                if($model->files){
                    foreach ($model->files as $oldFile) {
                        Storage::disk('public')->delete($oldFile->url);
                        $oldFile->delete(); 
                    }
                }
    
                foreach ($files as $file) {
                    $path = $file->store('uploads/thongbao', 'public');
                    File::create([
                        'id_thong_bao' => $model->id,
                        'ten_file'     => $file->getClientOriginalName(),
                        'url'          => $path,
                    ]);
                }
            }

            DB::commit();
            return $model; 

        } catch (\Exception $e) {
            DB::rollBack(); 
            throw $e;
        }   
    }
}