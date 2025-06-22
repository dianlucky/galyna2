<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Opsional: Tambahkan ini jika kamu pakai factory

class ProductModel extends Model
{
    // Opsional: Tambahkan trait HasFactory jika kamu menggunakan factory untuk testing/seeding
    // use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel yang benar di database
    // Dari gambar phpMyAdmin yang kamu kirim, nama tabel memang 'product' (singular).
    protected $table = 'product';

    // Primary key sesuai dengan struktur tabel di database kamu.
    // Dari gambar phpMyAdmin yang kamu kirim, primary key memang 'id_product'.
    protected $primaryKey = 'id_product';

    // Jika primary key bertipe integer dan auto increment (default Laravel, tapi bagus untuk eksplisit)
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom-kolom yang dapat diisi secara massal (mass assignable).
    // Pastikan semua kolom yang kamu inginkan untuk diisi melalui create() atau update() ada di sini.
    protected $fillable = [
        'name',
        'description',
        'rating',
        'code',
        'is_new',
        'cover_image',
        'id_category', // Foreign key ke tabel kategori
        'price',
        'weight' // Untuk fitur ongkir dinamis (bagus!)
    ];

    // Aktifkan created_at dan updated_at.
    // Default-nya sudah true, jadi baris ini sebenarnya tidak wajib tapi tidak salah jika ada.
    public $timestamps = true;

    /**
     * Definisi relasi ke model Category.
     * Product BELONGS TO Category (satu produk milik satu kategori).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        // Parameter 1: Model yang menjadi target relasi (CategoryModel::class)
        // Parameter 2: Nama foreign key di tabel 'product' (yaitu 'id_category')
        // Parameter 3: Nama primary key di tabel 'category' (yaitu 'id_category' berdasarkan dugaan kita)
        return $this->belongsTo(CategoryModel::class, 'id_category', 'id_category');
    }

    // Jika ada relasi lain (misal ke ProductImage, jika ada tabel product_image)
    /*
    public function images()
    {
        // Asumsi: tabel 'product_image' memiliki kolom 'product_id' yang merujuk ke 'id_product' di tabel 'product'
        return $this->hasMany(ProductImageModel::class, 'product_id', 'id_product');
    }
    */
}