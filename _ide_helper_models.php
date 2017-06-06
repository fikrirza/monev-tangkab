<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Indikator
 *
 * @property int $id
 * @property int $kegiatan_id
 * @property string $nama
 * @property string $deskripsi
 * @property float $target
 * @property string $satuan
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Kegiatan $kegiatan
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereDeskripsi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereKegiatanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereNama($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereSatuan($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereTarget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Indikator whereUpdatedAt($value)
 */
	class Indikator extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ItemKegiatan
 *
 * @property int $id
 * @property int $kegiatan_id
 * @property string $rekening
 * @property string $nama
 * @property float $nilai_1
 * @property string $satuan_1
 * @property float $nilai_2
 * @property string $satuan_2
 * @property float $nilai_3
 * @property string $satuan_3
 * @property float $fisik
 * @property float $realisasi
 * @property float $total
 * @property string $expr
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Kegiatan $kegiatan
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereExpr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereFisik($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereKegiatanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereNama($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereNilai1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereNilai2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereNilai3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereRealisasi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereRekening($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereSatuan1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereSatuan2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereSatuan3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ItemKegiatan whereUpdatedAt($value)
 */
	class ItemKegiatan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kegiatan
 *
 * @property int $id
 * @property int $program_id
 * @property string $rekening
 * @property string $nama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Program $program
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereNama($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereProgramId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereRekening($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Kegiatan whereUpdatedAt($value)
 */
	class Kegiatan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Program
 *
 * @property int $id
 * @property string $rekening
 * @property string $skpd_id
 * @property string $nama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Kegiatan[] $kegiatan
 * @property-read \App\Models\Skpd $skpd
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereNama($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereRekening($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereSkpdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Program whereUpdatedAt($value)
 */
	class Program extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Skpd
 *
 * @property string $id
 * @property string $nama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd whereNama($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Skpd whereUpdatedAt($value)
 */
	class Skpd extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $skpd_id
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\Models\Skpd $skpd
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSkpdId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

