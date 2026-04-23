<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category ID</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Stock</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"></th>
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
    <center>
    <div class="max-w-3xl bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-dashed border-4 border-orange-500 dark:border-gray-600 flex flex-col items-center justify-center min-h-[200px]">
    <center>
    <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tambah Item</label>
    <input type="text" id="disabledTextInput" class="form-control" placeholder="Category ID">
  </div>
  <div class="mb-3">
    <input type="text" id="disabledTextInput" class="form-control" placeholder="Nama Produk">
  </div>
  <div class="mb-3">
    <input type="text" id="disabledTextInput" class="form-control" placeholder="Harga">
  </div>
  <div class="mb-3">
    <input type="text" id="disabledTextInput" class="form-control" placeholder="Stock">
  </div>
  <!-- <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <center>
    </div>
    </center>
</x-app-layout>