<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-button-link-secondary href="{{ route('transaction.index') }}">Kembali</x-button-link-secondary>
            <div class="bg-white shadow-sm sm:rounded-lg mt-3">
                <div class="p-12 text-gray-800 overflow-x-auto">
                    <header class="mb-3">
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ __('Buat Transaksi') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Mohon isi kolom dibawah dengan benar.') }}
                        </p>
                    </header>
                    <div class="divider"></div>
                    <form action="{{ route('transaction.store') }}" method="POST" id="mainForm">
                        @csrf
                        @php
                        $data = App\Models\Sale::orderBy('id', 'DESC')->first();
                        if($data){
                        $urutan = (int) explode('-', $data->id)[1];
                        $urutan++;
                        } else {
                        $urutan = 1;
                        }
                        $id = 'TRN-'.sprintf("%03s", $urutan);
                        @endphp

                        <div class="max-2-xl mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-2 gap-5">
                                    <div class="form-control col">
                                        <x-input-label for="id" :value="__('ID Transaksi')" required />
                                        <x-text-input id="id" name="id" type="text" class="mt-1 mb-3 block w-full cursor-not-allowed" :value="$id" readonly />
                                    </div>
                                    <div class="form-control col">
                                        <x-input-label for="customer" :value="__('Nama Customer')" required />
                                        <x-text-input id="customer" name="customer" type="text" class="mt-1 mb-3 block w-full" :value="old('customer')" required autofocus />
                                        <x-input-error class="mt-2" :messages="$errors->get('customer')" />
                                    </div>
                                </div>
                                <input type="hidden" name="product" id="productHidden">
                                <input type="hidden" name="grand_total" id="total_price">
                                <div class="divider"></div>
                                <div class="bg-gray-100 p-3 rounded-md">
                                    <form action="#" method="post" id="product-form" class="mt-3">
                                        @csrf
                                        <div class="max-2-xl mt-3">
                                            <div class="w-full mb-3">
                                                <div class="grid grid-cols-2 gap-5">
                                                    <div class="col form-control">
                                                        <x-input-label for="product_id" :value="__('Pilih Product')" required />
                                                        <select id="product_id" class="select select-bordered">
                                                            <option selected disabled>-- Pilih product ---</option>
                                                            @foreach ($products as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error class="mt-2" :messages="$errors->get('customer')" />
                                                    </div>
                                                    <div class="col form-control">
                                                        <x-input-label for="quantity" :value="__('Quantity')" required />
                                                        <x-text-input id="quantity" name="quantity" type="number" class="mb-3 block w-full" min="0" required autofocus disabled />
                                                        <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                                                        <span class="text-xs text-red-600" hidden id="errorStok">
                                                            Stok product tidak mencukupi!
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-3 gap-5">
                                                    <div class="col form-control">
                                                        <x-input-label for="stock" :value="__('Stock')" />
                                                        <input type="number" class="input input-bordered w-full cursor-not-allowed" id="stock" readonly>
                                                    </div>
                                                    <div class="col form-control">
                                                        <x-input-label for="price" :value="__('Harga Satuan')" />
                                                        <input type="text" class="input input-bordered w-full cursor-not-allowed" id="price" readonly>
                                                    </div>
                                                    <div class="col form-control">
                                                        <x-input-label for="sub_total" :value="__('Estimasi Harga')" />
                                                        <input type="text" class="input input-bordered w-full cursor-not-allowed" id="sub_total" readonly>
                                                        <input type="hidden" id="sub_total_hidden" readonly>
                                                        <input type="hidden" id="product_name" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <x-primary-button type="button" id="btnAddProduct"><i class="bi bi-plus"></i> Tambah Product</x-primary-button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="divider"></div>
                                <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
                                    <div class="bg-gray-100 lg:col-span-2 p-5 rounded-md h-[305px] overflow-y-auto">
                                        <h1 class="text-base font-semibold">Keranjang</h1>
                                        <table class="table" id="cartTable">
                                            <thead>
                                                <tr>
                                                  <th class="w-[1%] text-center font-bold">#</th>
                                                  <th>Nama Product</th>
                                                  <th>Qty</th>
                                                  <th>Sub Total</th>
                                                  <th class="w-[1%] text-center"><i class="bi bi-gear-fill"></i></th>
                                                </tr>
                                              </thead>
                                              <tbody>

                                              </tbody>
                                        </table>
                                    </div>

                                    <div class="bg-gray-100 p-5 rounded-md shadow-md">
                                        <h1 class="text-base font-semibold">Ringkasan Pesanan</h1>
                                        <div class="flex flex-col">
                                            <div class="bg-base-300 p-5 rounded-lg mt-3">
                                                <h1 class="text-base font-normal">Grand Total</h1>
                                                <h1 id="grand-total" class="text-2xl text-red-600 font-extrabold transition-all duration-200">Rp 1.000.000</h1>
                                            </div>
                                            <div class="form-control mt-3 mb-3">
                                                <x-input-label for="payment_method" :value="__('Metode Pembayaran')" required />
                                                <x-select-input id="payment_method" name="payment_method" :options="$paymentMethod" required />
                                                <x-input-error class="mt-2" :messages="$errors->get('payment_method')" />
                                            </div>
                                            <x-primary-button type="submit"><i class="bi bi-floppy-fill"></i> Submit</x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let cart = [];
        $(document).ready(function() {
            displayCart();
            let productName;
            let productPrice;
            let stock;

            $('#product_id').select2({
                width: '100%',
                theme: "bootstrap-5"
            });

            $('#product_id').change(function() {
                const productId = $(this).val();
                $('#quantity').attr('disabled', false);

                $.ajax({
                    url: '/get-produk/' + productId
                    , type: 'GET'
                    , success: function(data) {
                        const formattedPrice = formatRupiah(data.price);

                        productName = data.name;
                        productPrice = data.price;
                        stock = data.stock;

                        $('#product_name').val(data.name);
                        $('#stock').val(data.stock);
                        $('#price').val(formattedPrice);
                    },
                });
            });

            $('#quantity').on('input', function() {
                const quantity = $(this).val();

                if (quantity > stock) {
                    $('#btnAddProduct').attr('disabled', true);
                    $('#errorStok').show()
                    $('#quantity').addClass('focus:border-red-600');
                    $('#sub_total').val('');
                } else {
                    $('#btnAddProduct').attr('disabled', false);
                    $('#quantity').removeClass('focus:border-red-600');
                    $('#errorStok').hide();

                    let sub_total = productPrice * quantity;
                    const formattedTotal = formatRupiah(sub_total);
                    $('#sub_total').val(formattedTotal);
                    $('#sub_total_hidden').val(sub_total);
                }
            });

            $('#btnAddProduct').click(function(e) {
                e.preventDefault();

                const productId = $('#product_id').val();
                const productName = $('#product_name').val();
                const quantity = $('#quantity').val();
                const subTotal = $('#sub_total_hidden').val();

                const product = {
                    productId,
                    productName,
                    quantity,
                    subTotal,
                };

                addToCart(product);

                $('#product_id').val('');
                $('#quantity').val('').attr('disabled', true);
                $('#stock').val('');
                $('#price').val('');
                $('#sub_total').val('');
                $('#sub_total_hidden').val('');

                const Toast = Swal.mixin({
                    toast: true
                    , position: "top-end"
                    , showConfirmButton: false
                    , timer: 3000
                    , timerProgressBar: true
                    , didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success"
                    , title: "Product telah ditambahkan!"
                });
                displayCart();
            });

            $('#mainForm').submit(function() {
                sessionStorage.removeItem('cart');
                return true;
            });

            function displayCart() {
                let cartFromSession = JSON.parse(sessionStorage.getItem('cart')) || [];
                let tableBody = $('#cartTable tbody');
                let tableHead = $('#cartTable thead');
                let grandTotalElement = $('#grand-total');

                // Mengosongkan isi tabel
                tableBody.empty();

                // Menambahkan setiap produk ke tabel
                if (cartFromSession.length === 0) {
                    tableBody.html('<tr><td colspan="5" class="text-center">Belum ada product ditambahkan.</td></tr>');
                    tableHead.hide();
                    updateGrandTotal(0);
                } else {
                    tableHead.show();
                    let grandTotal = 0;
                    cartFromSession.forEach(function(product, index) {
                        const formattedSubTotal = formatRupiah(product.subTotal);
                        grandTotal += parseFloat(product.subTotal);
                        let row = `<tr>
                                        <td class="text-center font-bold">${index + 1}</td>
                                        <td>${product.productName}</td>
                                        <td>${product.quantity}</td>
                                        <td>${formattedSubTotal}</td>
                                        <td><button class="btn bg-red-500 hover:bg-red-600 btn-sm text-white" onclick="removeProduct(${index})"><i class="bi bi-trash-fill text-center"></i></button></td>
                                    </tr>`;

                        tableBody.append(row);
                    });

                    updateGrandTotal(grandTotal);
                    updateProductHidden(cartFromSession);
                }
            }

            window.removeProduct = function(index) {
                let cartFromSession  = JSON.parse(sessionStorage.getItem('cart')) || [];

                // Menghapus produk dari array
                cartFromSession.splice(index, 1);
                cart.splice(index, 1);

                // Menyimpan kembali data keranjang ke sessionStorage
                saveCartToSession(cartFromSession );

                // Menampilkan ulang data dalam tabel
                displayCart();
            };

            function addToCart(product) {
                cart.push(product);
                saveCartToSession(cart);
                displayCart();
                // $('#productHidden').val(JSON.stringify(cart));
            }

            function saveCartToSession(cart) {
                sessionStorage.setItem('cart', JSON.stringify(cart));
            }

            function updateGrandTotal(total) {
                const formattedGrandTotal = formatRupiah(total) + ',-';
                $('#grand-total').text(formattedGrandTotal);
                $('#total_price').val(total);
            }

            function updateProductHidden(cart) {
                $('#productHidden').val(JSON.stringify(cart));
            }

            function formatRupiah(angka) {
                var numberString = angka.toString();
                var split = numberString.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp ' + rupiah;
            }
        });

    </script>
</x-app-layout>
