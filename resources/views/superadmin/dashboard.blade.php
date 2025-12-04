@extends('layouts.app') {{-- atau tanpa layout, sesuaikan --}}

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
  <header class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Super Admin Dashboard</h1>
    <p class="text-gray-600">Pilih bagian untuk diakses</p>
  </header>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <a href="/dashboard/umum" class="block bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-xl shadow transition">
      <h2 class="text-xl font-bold">Bagian Umum</h2>
    </a>
    <a href="/dashboard/keuangan" class="block bg-green-600 hover:bg-green-700 text-white p-6 rounded-xl shadow transition">
      <h2 class="text-xl font-bold">Bagian Keuangan</h2>
    </a>
    <a href="/dashboard/fasilitasi" class="block bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-xl shadow transition">
      <h2 class="text-xl font-bold">Bagian Fasilitasi</h2>
    </a>
    <a href="/dashboard/persidangan" class="block bg-red-600 hover:bg-red-700 text-white p-6 rounded-xl shadow transition">
      <h2 class="text-xl font-bold">Bagian Persidangan</h2>
    </a>
  </div>

  <!-- Logout -->
  <form action="{{ route('logout') }}" method="POST" class="mt-8">
    @csrf
    <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg hover:bg-gray-800">
      Logout
    </button>
  </form>
</div>
@endsection