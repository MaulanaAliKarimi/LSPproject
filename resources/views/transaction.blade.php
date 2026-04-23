<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID User</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Total</th>
      <th scope="col">Total pembayaran</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>
        <!-- <button type="submit" class="btn btn-success">Edit</button>
        <button type="submit" class="btn btn-danger">Delete</button> -->
      </td>
    </tr>
    <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr> -->
  </tbody>
</table>
    </div>
</x-app-layout>