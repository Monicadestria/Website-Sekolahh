<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\SectionMap;
use App\Models\SectionTagline;
use App\Models\SectionSlider;
use App\Models\SectionGhp;
use App\Models\SectionGhpImg;
use App\Models\SectionHero;
use App\Models\SectionHeroSlider;
use App\Models\SectionLine;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class SectionController extends Controller
{
 protected $responseErrorCreate, $responseSuccessCreate;
 protected $responseErrorUpdate, $responseSuccessUpdate;
 protected $responseErrorDelete, $responseSuccessDelete, $responseWarningMin1Img;
 protected $responseWarningTrixGhp, $responseWarningNama, $responseWarningTagline, $responseWarningPeta;
 protected $responseWarningTeksHero, $responseWarningTeksTombol;
 protected $responseWarningUrutanFirst, $responseWarningUrutanLast, $responseWarningMax5Img;

 public function __construct()
 {
  $this->responseWarningMax5Img = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Jumlah gambar sudah mencapai batas.',
  ];
  $this->responseWarningMin1Img = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Minimal ada 1 gambar.',
  ];
  $this->responseWarningUrutanLast = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Data sudah berada di paling bawah.',
  ];
  $this->responseWarningUrutanFirst = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Data sudah berada di paling atas.',
  ];
  $this->responseWarningTeksTombol = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Teks tombol harus diisi.',
  ];
  $this->responseWarningTeksHero = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Teks hero harus diisi.',
  ];
  $this->responseWarningPeta = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Peta harus diisi.',
  ];
  $this->responseWarningTagline = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Slogan tagline harus diisi.',
  ];
  $this->responseWarningNama = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Nama section harus diisi.',
  ];
  $this->responseWarningTrixGhp = [
   'icon' => 'warning',
   'title' => 'Perhatian!',
   'message' => 'Konten harus diisi.',
  ];
  $this->responseErrorCreate = [
   'icon' => 'error',
   'title' => 'Gagal!',
   'message' => 'Data gagal ditambahkan.',
  ];
  $this->responseErrorUpdate = [
   'icon' => 'error',
   'title' => 'Gagal!',
   'message' => 'Data gagal diubah.',
  ];
  $this->responseErrorDelete = [
   'icon' => 'error',
   'title' => 'Gagal!',
   'message' => 'Data gagal dihapus.',
  ];
  $this->responseSuccessCreate = [
   'icon' => 'success',
   'title' => 'Berhasil!',
   'message' => 'Data berhasil ditambahkan.',
  ];
  $this->responseSuccessUpdate = [
   'icon' => 'success',
   'title' => 'Berhasil!',
   'message' => 'Data berhasil diubah.',
  ];
  $this->responseSuccessDelete = [
   'icon' => 'success',
   'title' => 'Berhasil!',
   'message' => 'Data berhasil dihapus.',
  ];
 }

 public function index()
 {
  $pratinjau = Section::where('active', true)->orderBy('urutan')->get();
  $slug = Setting::withoutGlobalScope('user_query_scope')->where('created_by', auth()->user()->id)->pluck('slug')->first();
  $max = Section::count();
  $data = [
   'title' => 'Section',
   'head' => 'Data Section',
   'section' => Section::orderBy('created_at', 'desc')->get(),
   'pratinjau' => $pratinjau,
   'max' => $max,
   'slug' => $slug,
  ];
  // dd($data['pratinjau']);
  return view('sections.index', $data);
 }

 public function getPratinjauSection()
 {
  $data = [
   'section' => Section::orderBy('urutan')->get(),
   'pratinjau' => Section::where('active', true)->orderBy('urutan')->get(),
   'max' => Section::count(),
   'slug' => Setting::withoutGlobalScope('user_query_scope')->where('created_by', auth()->user()->id)->pluck('slug')->first(),
  ];
  $response = [
   'data' => view('sections.preview', $data)->render(),
  ];
  return response()->json($response);
 }

 public function sectionTable()
 {
  $data = [
   'section' => Section::orderBy('created_at', 'desc')->get(),
   'pratinjau' => Section::orderBy('urutan')->where('active', true)->get(),
   'max' => Section::count(),
  ];
  $response = [
   'data' => view('sections.table', $data)->render(),
  ];
  return response()->json($response);
 }

 // Fungsi untuk mengambil section & detail section 
 private function getSectionPartialDetails($id, $message, $icon)
 {
  $section = Section::findOrFail($id);
  $partial = $section->partial;
  if ($partial == 'tagline') {
   $sectionDetail = SectionTagline::where('section_id', $section->id)->first();
  } else if ($partial == 'peta') {
   $sectionDetail = SectionMap::where('section_id', $section->id)->first();
  } else if ($partial == 'line') {
   $sectionDetail = SectionLine::where('section_id', $section->id)->first();
  } else if ($partial == 'slide_show') {
   $gambar = SectionSlider::where('section_id', $section->id)->get();
  } else if ($partial == 'hero') {
   $sectionGambar = SectionHero::where('section_id', $section->id)->first();
   $data['dataHero'] = $sectionGambar;
   $gambar = SectionHeroSlider::where('section_hero_id', $sectionGambar->id)->get();
   list($button, $route) = $this->getUrlButtonHero($section->id);
   $data['linkUrlButtonHero'] = $button;
   $data['linkHrefButtonHero'] = $route;
  } else if ($partial == 'ghp') {
   $sectionGHP = SectionGhp::where('section_id', $section->id)->first();
   $data['dataGhp'] = $sectionGHP;
   $gambar = SectionGhpImg::where('section_ghp_id', $sectionGHP->id)->get();
  }

  if (in_array($partial, ['tagline', 'peta', 'line'])) {
   $data['detailSection'] = $sectionDetail;
  } else {
   if ($partial == 'slide_show') {
    $partial = 'slider';
   }
   $cekJumlahImg = $gambar->count();
   $maxImg = 5 - $cekJumlahImg;
   $data['maxImg'] = $maxImg;
   foreach ($gambar as $gbr) {
    $gbr->file = asset('storage/section/' . $partial . '/' . $gbr->file) . '?t=' . time();
    $data['detailSection'][] = $gbr;
   }
  }

  $data['section'] = $section;
  $title = $icon == 'success' ? 'Berhasil!' : ($icon == 'warning' ? 'Perhatian!' : 'Gagal!');


  $datas = [
   'icon' => $icon, // warning, error, success
   'title' => $title,
   'message' => $message, // dihapus, diubah, ditambahkan
   'jenis' => $partial, // slider ghp hero
  ];
  $response = array_merge($datas, [
   'newData' => $data,
  ]);
  return response()->json($response);
 }

 public function getUrlButtonHero($id)
 {
  $slug = Setting::withoutGlobalScope('user_query_scope')->where('created_by', auth()->user()->id)->pluck('slug')->first();
  $sectionGambar = SectionHero::where('section_id', $id)->first();
  switch ($sectionGambar->link_button) {
   case '1':
    return ['Beranda', route('lp.home.index', ['slug' => $slug])];
   case '2':
    return ['Staf', route('lp.staff.index', ['slug' => $slug])];
   case '3':
    return ['Berita', route('lp.berita.index', ['slug' => $slug])];
   case '4':
    return ['Galeri Gambar', route('lp.galery.gambar.index', ['slug' => $slug])];
   case '5':
    return ['Galeri Video', route('lp.galery.video.index', ['slug' => $slug])];
   case '6':
    return ['Unduh', route('lp.unduh.index', ['slug' => $slug])];
   default:
    return ['', '#'];
  }
 }

 public function detailSlider($id)
 {
  $data = [];
  $section = Section::findOrFail($id);
  $sectionSlideshow = SectionSlider::where('section_id', $section->id)->get();
  $cekJumlahImg = SectionSlider::where('section_id', $section->id)->count();
  $maxImg = 5 - $cekJumlahImg;
  $jumlahImg = count($sectionSlideshow);
  if ($jumlahImg == 5) {
   $lebarImg = 'w-20';
  } elseif ($jumlahImg == 4) {
   $lebarImg = 'w-25';
  } else {
   $lebarImg = 'w-33';
  }
  $data = [
   'section' => $section,
   'maxImg' => $maxImg,
   'lebarImg' => $lebarImg,
   'jenis' => 'slide_show', // slider ghp hero
  ];
  foreach ($sectionSlideshow as $slideshow) {
   $data['detailSection'][] = $slideshow;
  }
  $response = [
   // 'newData' => $data,
   'data' => view('sections.details.slide_show', $data)->render(),
  ];
  return response()->json($response);
  // return response()->json($data);
 }

 public function detailHero($id)
 {
  $data = [];
  $section = Section::findOrFail($id);
  $sectionGambar = SectionHero::where('section_id', $section->id)->first();
  $gambarHero = SectionHeroSlider::where('section_hero_id', $sectionGambar->id)->get();
  $cekJumlahImg = SectionHeroSlider::where('section_hero_id', $sectionGambar->id)->count();
  $maxImg = 5 - $cekJumlahImg;
  $jumlahImg = count($gambarHero);
  if ($jumlahImg == 5) {
   $lebarImg = 'w-20';
  } elseif ($jumlahImg == 4) {
   $lebarImg = 'w-25';
  } else {
   $lebarImg = 'w-33';
  }
  $data = [
   'section' => $section,
   'dataHero' => $sectionGambar,
   'maxImg' => $maxImg,
   'lebarImg' => $lebarImg,
   'jenis' => 'hero', // slider ghp hero
  ];
  list($button, $route) = $this->getUrlButtonHero($section->id);
  $data['linkUrlButtonHero'] = $button;
  $data['linkHrefButtonHero'] = $route;
  foreach ($gambarHero as $gbr) {
   $data['detailSection'][] = $gbr;
  }
  $response = [
   // 'newData' => $data,
   'data' => view('sections.details.hero', $data)->render(),
  ];
  return response()->json($response);
  // return response()->json($data);
 }


 public function detailGhp($id)
 {
  $data = [];
  $section = Section::findOrFail($id);
  $sectionGHP = SectionGhp::where('section_id', $section->id)->first();
  $gambarGHP = SectionGhpImg::where('section_ghp_id', $sectionGHP->id)->get();
  $cekJumlahImg = SectionGhpImg::where('section_ghp_id', $sectionGHP->id)->count();
  $maxImg = 5 - $cekJumlahImg;
  $jumlahImg = count($gambarGHP);
  foreach ($gambarGHP as $gbrGHP) {
   $data['detailSection'][] = $gbrGHP;
  }

  if ($jumlahImg == 5) {
   $lebarImg = 'w-20';
  } elseif ($jumlahImg == 4) {
   $lebarImg = 'w-25';
  } else {
   $lebarImg = 'w-33';
  }
  $data = [
   'section' => $section,
   'dataGhp' => $sectionGHP,
   'maxImg' => $maxImg,
   'lebarImg' => $lebarImg,
   'jenis' => 'ghp', // slider ghp hero
  ];
  foreach ($gambarGHP as $gbr) {
   $data['detailSection'][] = $gbr;
  }
  $response = [
   // 'newData' => $data,
   'data' => view('sections.details.ghp', $data)->render(),
  ];
  return response()->json($response);
 }

 public function create()
 {
  $urutan = Section::count();
  $data = [
   'title' => 'Tambah Section',
   'urutan' => $urutan + 1,
  ];
  return view('sections.create', $data);
 }

 private function jsonMaxSection($name, $max)
 {
  return response()->json([
   'icon' => 'error',
   'title' => 'Gagal!',
   'message' => 'Section ' . $name . ' sudah melebihi batas (' . $max . ').',
  ]);
 }

 public function store(Request $request)
 {
  // dd($request->input('contentGhp'));
  $created_by = auth()->user()->id;
  $partial = $request->input('partial');
  $cekJumlahSection = Section::where('partial', $partial)->count();
  $cekTrimNama = trim($request->input('name'));
  $cekTrimTagline = trim($request->input('tagline'));
  $cekTrimPeta = trim($request->input('peta'));
  $cekTrimTeksHero = trim($request->input('text_hero'));
  $cekTrimTeksTombol = trim($request->input('text_button'));
  $cekTrimTrixGhp = trim($request->input('contentGhp'));
  if ($cekTrimNama === '') {
   return response()->json($this->responseWarningNama);
  }

  if ($partial === 'peta') {
   $jenis = 'Peta';
   if ($cekJumlahSection >= 2) {
    return $this->jsonMaxSection($jenis, $cekJumlahSection);
   }
   if ($cekTrimPeta === '') {
    return response()->json($this->responseWarningPeta);
   }
  } elseif ($partial === 'hero') {
   $jenis = 'Hero';
   if ($cekJumlahSection >= 3) {
    return $this->jsonMaxSection($jenis, $cekJumlahSection);
   }
   if ($cekTrimTeksHero === '') {
    return response()->json($this->responseWarningTeksHero);
   }
   if ($cekTrimTeksTombol === '') {
    return response()->json($this->responseWarningTeksTombol);
   }
  } elseif ($partial === 'ghp') {
   $jenis = 'Gambar Head Paragraf';
   if ($cekJumlahSection >= 3) {
    return $this->jsonMaxSection($jenis, $cekJumlahSection);
   }
   // masih bisa input spasi karena saat input spasi dikasih div sama trix
   if ($cekTrimTrixGhp === '') {
    return response()->json($this->responseWarningTrixGhp);
   }
  } elseif ($partial === 'slide_show') {
   $jenis = 'Slide Show';
   if ($cekJumlahSection >= 3) {
    return $this->jsonMaxSection($jenis, $cekJumlahSection);
   }
  } elseif ($partial === 'tagline') {
   if ($cekTrimTagline === '') {
    return response()->json($this->responseWarningTagline);
   }
   $jenis = 'Slogan';
  } elseif ($partial === 'line') {
   $jenis = 'Garis';
  }

  $section = new Section();
  $urutan = $request->input('urutan');
  $dataUrutan = Section::where('urutan', '>=', $urutan)->orderBy('urutan')->get();
  $jumlahDataSection = Section::count();
  $maxUrutan = $jumlahDataSection + 1;
  $idSection = Str::uuid();
  $section->id = $idSection;
  $section->name = $request->input('name');
  $section->partial = $request->input('partial');
  $section->active = $request->input('status');
  $section->margin_top = $request->input('margin_top');
  $section->margin_bottom = $request->input('margin_bottom');
  $section->size = $request->input('size');

  if ($dataUrutan->isNotEmpty()) {
   foreach ($dataUrutan as $gantiUrutan) {
    $gantiUrutan->urutan = $gantiUrutan->urutan + 1;
    $gantiUrutan->save();
   }
  }
  if ($urutan > $maxUrutan) {
   $section->urutan  = $maxUrutan;
  } else {
   $section->urutan = $urutan;
  }
  $section->jenis = $jenis;
  $section->save();

  if ($partial === 'tagline') {
   $tagline = new SectionTagline();
   $tagline->id = Str::uuid();
   $tagline->section_id = $idSection;
   $tagline->name = $request->input('tagline');
   $tagline->save();

   return response()->json($this->responseSuccessCreate);
  } elseif ($partial === 'peta') {
   $peta = new SectionMap();
   $peta->id = Str::uuid();
   $peta->section_id = $idSection;
   $peta->url = $request->input('peta');
   $peta->save();

   return response()->json($this->responseSuccessCreate);
  } elseif ($partial === 'line') {
   $line = new SectionLine();
   $line->id = Str::uuid();
   $line->section_id = $idSection;
   $line->position = $request->input('position');
   $line->round = $request->input('round');
   $line->color = $request->input('color');
   $line->bold = $request->input('bold');
   $line->length = $request->input('length');
   $line->amount = $request->input('amount');
   $line->save();

   return response()->json($this->responseSuccessCreate);
  } elseif ($partial === 'hero') {
   $hero = new SectionHero();
   $idHero = Str::uuid();
   $hero->id = $idHero;
   $hero->section_id = $idSection;
   $hero->text_hero = $request->input('text_hero');
   $hero->text_button = $request->input('text_button');
   $hero->link_button = $request->input('link_button');
   $hero->save();
   $imageData = [];
   $files = $request->file('hero');
   foreach ($files as $file) {
    $uuid = Str::uuid();
    $extension = $file->getClientOriginalExtension();
    $fileName = $uuid . '.' . $extension;
    $path = 'public/section/hero';
    $file->storeAs($path, $fileName);
    $imageData[] = [
     'id' => $uuid,
     'section_hero_id' => $idHero,
     'file' => $fileName,
     'created_by' =>  $created_by,
     'updated_by' =>  $created_by,
     'created_at' =>  Carbon::now(),
     'updated_at' =>  Carbon::now(),
    ];
   }
   SectionHeroSlider::insert($imageData);

   return response()->json($this->responseSuccessCreate);
  } elseif ($partial === 'ghp') {
   $ghp = new SectionGhp();
   $idGhp = Str::uuid();
   $ghp->id = $idGhp;
   $ghp->section_id = $idSection;
   $ghp->content = $request->input('contentGhp');
   $ghp->save();
   $imageData = [];
   $files = $request->file('imgGhp');
   foreach ($files as $file) {
    $uuid = Str::uuid();
    $extension = $file->getClientOriginalExtension();
    $fileName = $uuid . '.' . $extension;
    $path = 'public/section/ghp';
    $file->storeAs($path, $fileName);
    $imageData[] = [
     'id' => $uuid,
     'section_ghp_id' => $idGhp,
     'file' => $fileName,
     'created_by' =>  $created_by,
     'updated_by' =>  $created_by,
     'created_at' =>  Carbon::now(),
     'updated_at' =>  Carbon::now(),
    ];
   }
   SectionGhpImg::insert($imageData);

   return response()->json($this->responseSuccessCreate);
  } elseif ($partial === 'slide_show') {
   $imageData = [];
   $files = $request->file('slider');
   foreach ($files as $file) {
    // Lakukan apa yang Anda butuhkan dengan setiap file gambar di sini
    $uuid = Str::uuid();
    $extension = $file->getClientOriginalExtension();
    $fileName = $uuid . '.' . $extension;
    $path = 'public/section/slider';
    $file->storeAs($path, $fileName);
    $imageData[] = [
     'id' => $uuid,
     'section_id' => $idSection,
     'file' => $fileName,
     'created_by' =>  $created_by,
     'updated_by' =>  $created_by,
     'created_at' =>  Carbon::now(),
     'updated_at' =>  Carbon::now(),
    ];
   }
   SectionSlider::insert($imageData);
   return response()->json($this->responseSuccessCreate);
  }
  return response()->json($this->responseErrorCreate);
 }

 public function detailSection($id)
 {
  $data = [];
  $section = Section::findOrFail($id);
  $data = [
   'title' => 'Detail Section',
   'section' => $section,
  ];

  if ($section->partial == 'tagline') {
   $sectionTulisan = SectionTagline::where('section_id', $section->id)->first();
   $data['detailSection'] = $sectionTulisan;
  } elseif ($section->partial == 'line') {
   $sectionLine = SectionLine::where('section_id', $section->id)->first();
   $data['detailSection'] = $sectionLine;
  } elseif ($section->partial == 'peta') {
   $sectionPeta = SectionMap::where('section_id', $section->id)->first();
   $data['detailSection'] = $sectionPeta;
  } elseif ($section->partial == 'slide_show') {
   $sectionSlideshow = SectionSlider::where('section_id', $section->id)->get();
   $cekJumlahImg = $sectionSlideshow->count();
   $maxImg = 5 - $cekJumlahImg;
   $data['maxImg'] = $maxImg;
   foreach ($sectionSlideshow as $slideshow) {
    $data['detailSection'][] = $slideshow;
   }

   // jarak
  } elseif ($section->partial == 'hero') {
   $sectionGambar = SectionHero::where('section_id', $section->id)->first();
   $data['dataHero'] = $sectionGambar;
   list($button, $route) = $this->getUrlButtonHero($section->id);
   $data['linkUrlButtonHero'] = $button;
   $data['linkHrefButtonHero'] = $route;
   $gambarHero = SectionHeroSlider::where('section_hero_id', $sectionGambar->id)->get();
   $cekJumlahImg = $gambarHero->count();
   $maxImg = 5 - $cekJumlahImg;
   $data['maxImg'] = $maxImg;
   foreach ($gambarHero as $gbr) {
    $data['detailSection'][] = $gbr;
   }

   // jarak
  } elseif ($section->partial == 'ghp') {
   $sectionGHP = SectionGhp::where('section_id', $section->id)->first();
   $data['dataGhp'] = $sectionGHP;
   $gambarGHP = SectionGhpImg::where('section_ghp_id', $sectionGHP->id)->get();
   // $cekJumlahImg = SectionGhpImg::where('section_ghp_id', $sectionGHP->id)->count();
   $cekJumlahImg = $gambarGHP->count();
   $maxImg = 5 - $cekJumlahImg;
   $data['maxImg'] = $maxImg;
   foreach ($gambarGHP as $gbrGHP) {
    $data['detailSection'][] = $gbrGHP;
   }
  }
  // dd($data['detailSection']);
  return view('sections.detail', $data);
 }

 public function update(Request $request, $id)
 {
  try {
   $cekTrimNamaSection = trim($request->input('name'));
   if ($cekTrimNamaSection === '') {
    return response()->json($this->responseWarningNama);
   }
   $section = Section::findOrFail($id);
   $urutanLama = $section->urutan;
   $urutanBaru = intval($request->urutan);

   // TURUN: urutan baru lebih besar, berarti urutan di bawahnya naik
   if ($urutanBaru != $urutanLama) {
    if ($urutanBaru > $urutanLama) {
     $urutanSection = Section::where('urutan', '>=', $urutanLama)->where('urutan', '<=', $urutanBaru)->orderBy('urutan')->get();
     foreach ($urutanSection as $urutan) {
      $urutan->urutan = $urutan->urutan - 1;
      $urutan->save();
     }
     // NAIK: urutan baru lebih kecil, berarti urutan di atasnya turun
    } elseif ($urutanBaru < $urutanLama) {
     $urutanSection = Section::where('urutan', '>=', $urutanBaru)->where('urutan', '<=', $urutanLama)->orderBy('urutan')->get();
     foreach ($urutanSection as $urutan) {
      $urutan->urutan = $urutan->urutan + 1;
      $urutan->save();
     }
    }
   }

   $section->urutan = $urutanBaru;
   $section->name = $request->name;
   $section->size = $request->size;
   $section->urutan = $request->urutan;
   $section->margin_top = $request->margin_top;
   $section->margin_bottom = $request->margin_bottom;
   $section->active = $request->active;
   $section->save();
   return response()->json($this->responseSuccessUpdate);
  } catch (Exception) {
   return response()->json($this->responseErrorUpdate);
  }
 }

 public function updateDetail(Request $request, $id)
 {
  try {
   $cekSection = $request->input('cekSection');
   if ($cekSection === 'tagline') {
    $cekTrimTagline = trim($request->input('tagline'));
    $tagline = SectionTagline::findOrFail($id);
    if ($cekTrimTagline === '') {
     return $this->getSectionPartialDetails($tagline->section_id, 'Slogan tagline harus diisi.', 'warning');
    }
    $tagline->update([
     'name' => $request->input('tagline'),
    ]);
    return $this->getSectionPartialDetails($tagline->section_id, 'Data berhasil diubah.', 'success');

    // jarak
   } elseif ($cekSection === 'peta') {
    $cekTrimPeta = trim($request->input('url'));
    $peta = SectionMap::findOrFail($id);
    if ($cekTrimPeta === '') {
     return $this->getSectionPartialDetails($peta->section_id, 'Peta harus diisi.', 'warning');
    }
    $peta->update([
     'url' => $request->input('url'),
    ]);
    return $this->getSectionPartialDetails($peta->section_id, 'Data berhasil diubah.', 'success');

    // jarak
   } elseif ($cekSection === 'line') {
    $line = SectionLine::findOrFail($id);
    $line->updated_by = auth()->user()->id;
    $line->position = $request->input('position');
    $line->round = $request->input('round');
    $line->color = $request->input('color');
    $line->bold = $request->input('bold');
    $line->length = $request->input('length');
    $line->amount = $request->input('amount');
    $line->save();
    return $this->getSectionPartialDetails($line->section_id, 'Data berhasil diubah.', 'success');

    // jarak
   } elseif ($cekSection === 'slide_show') {
    $cekUpdate = $request->input('cekUpdate');
    if ($cekUpdate === 'tambah_gambar') {
     $section = Section::findOrFail($id);
     $imageData = [];
     $files = $request->file('slider');
     $cekJumlahImg = SectionSlider::where('section_id', $section->id)->count();
     $sisaImg = 5 - $cekJumlahImg;
     $jumlahInput = count($files);

     if ($sisaImg  <= 0 || $cekJumlahImg >= 5 || $jumlahInput > $sisaImg) {
      return $this->getSectionPartialDetails($id, 'Jumlah gambar sudah mencapai batas.', 'warning');
     }

     foreach ($files as $file) {
      // Lakukan apa yang Anda butuhkan dengan setiap file gambar di sini
      $uuid = Str::uuid();
      $extension = $file->getClientOriginalExtension();
      $fileName = $uuid . '.' . $extension;
      $path = 'public/section/slider';
      $file->storeAs($path, $fileName);
      $imageData[] = [
       'id' => $uuid,
       'section_id' => $section->id,
       'file' => $fileName,
       'created_by' =>  auth()->user()->id,
       'updated_by' =>  auth()->user()->id,
       'created_at' =>  Carbon::now(),
       'updated_at' =>  Carbon::now(),
      ];
     }
     SectionSlider::insert($imageData);
     return $this->getSectionPartialDetails($id, 'Data berhasil ditambahkan.', 'success');
     // return response()->json($this->responseSuccessCreate);
    } elseif ($cekUpdate === 'ubah_gambar') {
     $slider = SectionSlider::findOrFail($id);
     $oldFile = $slider->file;
     $oldExtension = pathinfo($oldFile, PATHINFO_EXTENSION);
     $file = $request->file('slider');
     // $extension = $file->getClientOriginalExtension();
     $fileName = $id . '.' . $oldExtension;
     $path = 'public/section/slider';
     $file->storeAs($path, $fileName); // kesalahan pada saat storeAs
     $slider->update([
      'file' => $fileName,
      'updated_by' =>  auth()->user()->id,
      'updated_at' =>  Carbon::now(),
     ]);
     return $this->getSectionPartialDetails($slider->section_id, 'Data berhasil diubah.', 'success');
    }

    // jarak
   } elseif ($cekSection === 'hero') {
    $cekUpdate = $request->input('cekUpdate');
    if ($cekUpdate === 'tambah_gambar') {
     $section = Section::findOrFail($id);
     $sectionHero = SectionHero::where('section_id', $section->id)->first();
     $imageData = [];
     $files = $request->file('hero');
     $cekJumlahImg = SectionHeroSlider::where('section_hero_id', $sectionHero->id)->count();
     $sisaImg = 5 - $cekJumlahImg;
     $jumlahInput = count($files);
     if ($sisaImg  <= 0 || $cekJumlahImg >= 5 || $jumlahInput > $sisaImg) {
      return $this->getSectionPartialDetails($id, 'Jumlah gambar sudah mencapai batas.', 'warning');
     }
     foreach ($files as $file) {
      // Lakukan apa yang Anda butuhkan dengan setiap file gambar di sini
      $uuid = Str::uuid();
      $extension = $file->getClientOriginalExtension();
      $fileName = $uuid . '.' . $extension;
      $path = 'public/section/hero';
      $file->storeAs($path, $fileName);
      $imageData[] = [
       'id' => $uuid,
       'section_hero_id' => $sectionHero->id,
       'file' => $fileName,
       'created_by' =>  auth()->user()->id,
       'updated_by' =>  auth()->user()->id,
       'created_at' =>  Carbon::now(),
       'updated_at' =>  Carbon::now(),
      ];
     }
     SectionHeroSlider::insert($imageData);
     return $this->getSectionPartialDetails($id, 'Data berhasil diubah.', 'success');
     // return response()->json($this->responseSuccessCreate);
    } elseif ($cekUpdate === 'ubah_gambar') {
     $heroSlider = SectionHeroSlider::findOrFail($id);
     $hero = SectionHero::findOrFail($heroSlider->section_hero_id);
     $oldFile = $heroSlider->file;
     $oldExtension = pathinfo($oldFile, PATHINFO_EXTENSION);
     $file = $request->file('hero');
     // $extension = $file->getClientOriginalExtension();
     $fileName = $id . '.' . $oldExtension;
     $path = 'public/section/hero';
     $file->storeAs($path, $fileName);
     $heroSlider->update([
      'file' => $fileName,
      'updated_by' =>  auth()->user()->id,
      'updated_at' =>  Carbon::now(),
     ]);
     return $this->getSectionPartialDetails($hero->section_id, 'Data berhasil diubah.', 'success');
    } elseif ($cekUpdate === 'ubah_data') {
     $cekTrimTeksHero = trim($request->input('text_hero'));
     $cekTrimTeksTombol = trim($request->input('text_button'));
     if ($cekTrimTeksHero === '') {
      return $this->getSectionPartialDetails($id, 'Teks hero harus diisi.', 'warning');
     }
     if ($cekTrimTeksTombol === '') {
      return $this->getSectionPartialDetails($id, 'Teks tombol harus diisi.', 'warning');
     }
     $section = Section::findOrFail($id);
     $sectionHero = SectionHero::where('section_id', $section->id)->first();
     $sectionHero->update([
      'text_hero' => $request->input('text_hero'),
      'text_button' => $request->input('text_button'),
      'link_button' => $request->input('link_button'),
     ]);
     // return response()->json($this->responseSuccessUpdate);
     return $this->getSectionPartialDetails($id, 'Data berhasil diubah.', 'success');
    }

    // jarak
   } elseif ($cekSection === 'ghp') {
    $cekUpdate = $request->input('cekUpdate');
    if ($cekUpdate === 'tambah_gambar') {
     $section = Section::findOrFail($id);
     $sectionGhp = SectionGhp::where('section_id', $section->id)->first();
     $imageData = [];
     $files = $request->file('ghp');
     $cekJumlahImg = SectionGhpImg::where('section_ghp_id', $sectionGhp->id)->count();
     $sisaImg = 5 - $cekJumlahImg;
     $jumlahInput = count($files);
     if ($sisaImg  <= 0 || $cekJumlahImg >= 5 || $jumlahInput > $sisaImg) {
      // return response()->json($this->responseWarningMax5Img);
      return $this->getSectionPartialDetails($id, 'Jumlah gambar sudah mencapai batas.', 'warning');
     }
     foreach ($files as $file) {
      // Lakukan apa yang Anda butuhkan dengan setiap file gambar di sini
      $uuid = Str::uuid();
      $extension = $file->getClientOriginalExtension();
      $fileName = $uuid . '.' . $extension;
      $path = 'public/section/ghp';
      $file->storeAs($path, $fileName);
      $imageData[] = [
       'id' => $uuid,
       'section_ghp_id' => $sectionGhp->id,
       'file' => $fileName,
       'created_by' =>  auth()->user()->id,
       'updated_by' =>  auth()->user()->id,
       'created_at' =>  Carbon::now(),
       'updated_at' =>  Carbon::now(),
      ];
     }
     SectionGhpImg::insert($imageData);
     return $this->getSectionPartialDetails($id, 'Data berhasil diubah.', 'success');
     // return response()->json($this->responseSuccessCreate);
    } elseif ($cekUpdate === 'ubah_gambar') {
     $ghpImg = SectionGhpImg::findOrFail($id);
     $ghp = SectionGhp::findOrFail($ghpImg->section_ghp_id);
     $oldFile = $ghpImg->file;
     $oldExtension = pathinfo($oldFile, PATHINFO_EXTENSION);
     $file = $request->file('ghp');
     // $extension = $file->getClientOriginalExtension();
     $fileName = $id . '.' . $oldExtension;
     $path = 'public/section/ghp';
     $file->storeAs($path, $fileName);
     $ghpImg->update([
      'file' => $fileName,
      'updated_by' =>  auth()->user()->id,
      'updated_at' =>  Carbon::now(),
     ]);
     return $this->getSectionPartialDetails($ghp->section_id, 'Data berhasil diubah.', 'success');
     // return response()->json($this->responseSuccessUpdate);
    } elseif ($cekUpdate === 'ubah_data') {
     $cekTrimContentGhp = trim($request->input('contentGhp'));
     if ($cekTrimContentGhp === '') {
      // return response()->json($this->responseWarningTrixGhp);
      return $this->getSectionPartialDetails($id, 'Konten harus diisi.', 'warning');
     }
     $section = Section::findOrFail($id);
     $sectionGhp = SectionGhp::where('section_id', $section->id)->first();
     $sectionGhp->update([
      'content' => $request->input('contentGhp'),
     ]);
     // return response()->json($this->responseSuccessUpdate);
     return $this->getSectionPartialDetails($id, 'Data berhasil diubah.', 'success');
    }
   } else {
    return response()->json($this->responseErrorUpdate);
   }
  } catch (\Throwable $th) {
   if ($cekSection === 'slide_show' || $cekSection === 'hero' || $cekSection === 'ghp') {
    if ($cekUpdate === 'tambah_gambar') {
     return response()->json($this->responseErrorCreate);
    }
   }
   return response()->json($this->responseErrorUpdate);
  }
 }


 public function naik($id)
 {
  try {
   $section = Section::findOrFail($id);
   $currentOrder = intval($section->urutan);

   if ($currentOrder == 1) {
    return response()->json($this->responseWarningUrutanFirst);
   }
   $previousSection = Section::where('urutan', $currentOrder - 1)->first();

   $section->update(['urutan' => 0]);
   $previousSection->update(['urutan' => $currentOrder]);
   $section->update(['urutan' => $currentOrder - 1]);

   return response()->json($this->responseSuccessUpdate);
  } catch (Exception) {
   return response()->json($this->responseErrorUpdate);
  }
 }

 public function turun($id)
 {
  try {
   $section = Section::findOrFail($id);
   $currentOrder = $section->urutan;
   $totalSections = Section::count();

   if ($currentOrder == $totalSections) {
    return response()->json($this->responseWarningUrutanLast);
   }
   $nextSection = Section::where('urutan', $currentOrder + 1)->first();
   $section->update(['urutan' => 0]);
   $nextSection->update(['urutan' => $currentOrder]);
   $section->update(['urutan' => $currentOrder + 1]);

   return response()->json($this->responseSuccessUpdate);
  } catch (Exception) {
   return response()->json($this->responseErrorUpdate);
  }
 }

 public function active($id)
 {
  try {
   $section = Section::findOrFail($id);
   if ($section->active) {
    $active = 0;
   } else {
    $active = 1;
   }
   $section->update(['active' => $active]);
   return response()->json($this->responseSuccessUpdate);
  } catch (Exception) {
   return response()->json($this->responseErrorUpdate);
  }
 }

 public function delete($id)
 {
  try {
   $section = Section::findOrFail($id);
   $deletedOrder = intval($section->urutan);
   $section->active = 0;
   $section->urutan = -1;
   $section->save();

   // hapus data yang ada direlasi section
   if ($section->partial == 'tagline') {
    $tagline = SectionTagline::where('section_id', $id)->first();
    $tagline->delete();
   } elseif ($section->partial == 'line') {
    $line = SectionLine::where('section_id', $id)->first();
    $line->delete();
   } elseif ($section->partial == 'peta') {
    $map = SectionMap::where('section_id', $id)->first();
    $map->delete();
   } elseif ($section->partial == 'slide_show') {
    $slideshow = SectionSlider::where('section_id', $id)->get();
    foreach ($slideshow as $item) {
     $item->delete();
    }
   } elseif ($section->partial == 'hero') {
    $hero = SectionHero::where('section_id', $id)->first();
    $heroSlider = SectionHeroSlider::where('section_hero_id', $hero->id)->get();
    foreach ($heroSlider as $item) {
     $item->delete();
    }
    $hero->delete();
   } elseif ($section->partial == 'ghp') {
    $ghp = SectionGhp::where('section_id', $id)->first();
    $ghpImg = SectionGhpImg::where('section_ghp_id', $ghp->id)->get();
    foreach ($ghpImg as $item) {
     $item->delete();
    }
    $ghp->delete();
   }
   $section->delete();
   $this->urutanUpDelete($deletedOrder);
   return response()->json($this->responseSuccessDelete);
  } catch (Exception) {
   return response()->json($this->responseErrorDelete);
  }
 }

 public function deleteImg(Request $request, $id)
 {
  try {
   $partial = $request->input('partial');
   if ($partial === 'slide_show') {
    $slider = SectionSlider::findOrFail($id);
    $cekJumlahImg = SectionSlider::where('section_id', $slider->section_id)->count();
    if ($cekJumlahImg <= 1) {
     return $this->getSectionPartialDetails($slider->section_id, 'Minimal ada 1 gambar.', 'warning');
    } else {
     $slider->delete();
     return $this->getSectionPartialDetails($slider->section_id, 'Data berhasil dihapus.', 'success');
    }

    // jarak
   } elseif ($partial === 'hero') {
    $heroImg = SectionHeroSlider::findOrFail($id);
    $hero = SectionHero::findOrFail($heroImg->section_hero_id);
    $cekJumlahImg = SectionHeroSlider::where('section_hero_id', $heroImg->section_hero_id)->count();
    if ($cekJumlahImg <= 1) {
     return $this->getSectionPartialDetails($hero->section_id, 'Minimal ada 1 gambar.', 'warning');
    } else {
     $heroImg->delete();
     return $this->getSectionPartialDetails($hero->section_id, 'Data berhasil dihapus.', 'success');
    }
    // return response()->json($this->responseSuccessDelete);

    // jarak
   } elseif ($partial === 'ghp') {
    $ghpImg = SectionGhpImg::findOrFail($id);
    $ghp = SectionGhp::findOrFail($ghpImg->section_ghp_id);
    $cekJumlahImg = SectionGhpImg::where('section_ghp_id', $ghpImg->section_ghp_id)->count();
    if ($cekJumlahImg <= 1) {
     // return response()->json($this->responseWarningMin1Img);
     return $this->getSectionPartialDetails($ghp->section_id, 'Minimal ada 1 gambar.', 'warning');
    } else {
     $ghpImg->delete();
     // return response()->json($this->responseSuccessDelete);
     return $this->getSectionPartialDetails($ghp->section_id, 'Data berhasil dihapus.', 'success');
    }
   }
  } catch (Exception) {
   return response()->json($this->responseErrorDelete);
  }
 }

 public function urutanUpDelete($deletedOrder)
 {
  $sectionsToUpdate = Section::where('urutan', '>', $deletedOrder)->orderBy('urutan')->get();
  if ($sectionsToUpdate->isNotEmpty()) {
   foreach ($sectionsToUpdate as $gantiUrutan) {
    $gantiUrutan->urutan = $gantiUrutan->urutan - 1;
    $gantiUrutan->save();
   }
  }
 }
}
