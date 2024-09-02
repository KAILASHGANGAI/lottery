@extends('layouts.app')
@section('title', 'POS')

<style>
    .cart-container {
        max-height: 500px;
        /* Set your desired maximum height */
        overflow-y: auto;
    }
</style>

@section('content')
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-md-9">

                <div class="row" id="searchResults">
                    <!-- Sample products, replace with your actual products -->
                    @foreach ($products as $item)
                        <div class=" col-6 col-sm-6 col-md-3">
                            <div class="card" data-product-id="{{ $item->id }}">
                                <img src="{{ asset($item->image) }}" class="card-img-top " height="100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->product_name }}</h5> <br>
                                    <span>{{ $item->product_code }}</span>
                                    <p class="card-text">Nrs.{{ $item->selling_price }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

            <div class="col-md-3">
                <div class="cart-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Rs.</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Cart items will be displayed here -->
                        </tbody>
                    </table>
                    <hr>

                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <h4>Total:</h4>
                    <h4 id="total-price"></h4>

                </div>
                <div class="form">
                    <form action="{{ route('checkout') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Pay Amount</label>
                                    <input type="text" class="form-control" name="pay_amount" id="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Due Amount</label>
                                    <input type="text" class="form-control" name="due" id="">
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label for="exampleInputEmail1">Customer Name</label>
                                <input type="text" id="customerName" name="customer_name" class="form-control"
                                    value="{{ old('customer_name') }}" placeholder="Enter Full name">
                                <input type="hidden" id="customer_id" value="" name="customer_id" required>
                                <div id="options-container"></div>

                                @error('customer_name')
                                    <p class="error text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <button class="btn btn-success btn-block mt-3" id="checkout-btn">Checkout</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            fetchCartItems();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');


            function fetchCartItems() {
                $.ajax({
                    type: 'GET',
                    url: '/getcard',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },

                    success: function(response) {
                        console.log(response);
                        var cartItemsContainer = $('#cart-items');
                        var totalPriceContainer = $('#total-price');
                        var totalPrice = 0;
                        cartItemsContainer.empty();
                        if (response.datas.length > 0) {
                            $.each(response.datas, function(index, item) {

                                var tableRow = $('<tr>');

                                var itemNameCell = $('<td>', {
                                    text: item.product_name,
                                });

                                var itemQuantityCell = $('<td>');
                                var quantityInput = $('<input>', {
                                    type: 'number',
                                    value: item.quantity,
                                    min: 1,
                                    'data-product-id': item.id,
                                    class: 'quantity-input w-75',
                                });

                                itemQuantityCell.append(quantityInput);

                                var itemPriceCell = $('<td>', {
                                    text: (item.subtotal)
                                });
                                var removecell = $('<td>');
                                var removeBtn = $('<i>', {
                                    'data-product-id': item.id,
                                    class: 'fas fa-trash remove-from-cart',
                                });
                                removecell.append(removeBtn)
                                totalPrice += item.price * item.quantity;

                                tableRow.append(itemNameCell, itemQuantityCell,
                                    itemPriceCell, removecell);
                                cartItemsContainer.append(tableRow);
                            });

                            totalPriceContainer.text('Rs.' + totalPrice.toFixed(2));
                            updateCard()

                            removeItem()
                        } else {
                            cartItemsContainer.append('<p>No items in the cart.</p>');
                        }
                        // Handle the success response (e.g., update the UI, show a success message)
                        console.log('Product added to cart:', response);
                    },
                    error: function(error) {
                        // Handle the error response (e.g., show an error message)
                        console.error('Error adding product to cart:', error);
                    }
                });
            }

            $('.card').click(function() {
                var productId = $(this).data('product-id');

                // Make an AJAX request to add the product to the cart
                $.ajax({
                    type: 'POST',
                    url: '/add-to-cart/' + productId,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        fetchCartItems();

                        console.log('Product added to cart:', response);
                    },
                    error: function(error) {
                        // Handle the error response (e.g., show an error message)
                        console.error('Error adding product to cart:', error);
                    }
                });
            });

            function removeItem() {
                $('.remove-from-cart').on('click', function() {
                    var confirmed = window.confirm(
                        'Are you sure you want to remove this item from the cart?');

                    var productId = $(this).data('product-id');
                    if (confirmed) {
                        $.ajax({
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            url: '/remove-from-cart/' + productId,
                            success: function(response) {
                                // If successful, fetch and display updated cart items
                                fetchCartItems();
                            },
                            error: function(error) {
                                console.error(
                                    'Error removing item from cart:',
                                    error);
                            }
                        });
                    }
                });
            }

            function updateCard() {
                $('.quantity-input').on('input', function() {

                    var productId = $(this).data('product-id');
                    var newQuantity = $(this).val();

                    // Make an AJAX request to update the quantity on the server
                    $.ajax({
                        type: 'POST',
                        url: '/update-quantity/' + productId,
                        data: {
                            quantity: newQuantity
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            // If successful, fetch and display updated cart items
                            fetchCartItems();
                        },
                        error: function(error) {
                            console.error('Error updating quantity:',
                                error);
                        }
                    });
                });
            }


            $('#search').on('input', function() {
                var query = $(this).val();
                if (query.length > 0) {
                    performSearch();
                } else {
                    fetchCartItems();
                    return false;
                }

            });


            function performSearch() {
                var query = $('#search').val();
                // Make an AJAX request to fetch search results
                $.ajax({
                    type: 'POST',
                    url: '/products-search',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        searchitem: query
                    },
                    success: function(data) {
                        displaySearchResults(data);
                    },
                    error: function(error) {
                        console.error('Error performing search:', error);
                    }
                });
            }

            function displaySearchResults(data) {
                // Clear previous search results
                console.log(data)
                var searchResultsContainer = $('#searchResults');

                searchResultsContainer.empty();


                if (data.length > 0) {
                    $.each(data, function(index, item) {
                        var card =
                            "<div class='col-6 col-sm-6 col-md-3'>" +
                            "<div class='card' data-product-id='" + item.id + "'>" +
                            "<img src='" + item.image + "' class='card-img-top ' height='100'>" +
                            "<div class='card-body'>" +
                            "<h5 class='card-title'>" + item.product_name + "</h5> <br>" +
                            "<span>" + item.product_code + "</span>" +
                            "<p class='card-text'>Nrs." + item.selling_price + "</p>" +
                            "<button class='btn btn-primary add-to-cart'>Add to Cart</button>" +
                            "</div>" +
                            "</div>" +
                            "</div>";

                        var cardElement = $(card);

                        // Attach a click event listener to the "Add to Cart" button
                        cardElement.find('.card').on('click', function() {
                            var productId = $(this).data('product-id');
                            $.ajax({
                                type: 'POST',
                                url: '/add-to-cart/' + productId,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                success: function(response) {
                                    fetchCartItems();

                                    console.log('Product added to cart:', response);
                                },
                                error: function(error) {
                                    // Handle the error response (e.g., show an error message)
                                    console.error('Error adding product to cart:',
                                        error);
                                }
                            });
                        });

                        searchResultsContainer.append(cardElement);
                    });

                } else {
                    searchResultsContainer.append('<p>No products found.</p>');
                }
            }
        });

        $(document).ready(function() {
            var customerNameInput = $('#customerName');
            var optionsContainer = $('#options-container');
            var customer_id = $('#customer_id');

            customerNameInput.on('input', function() {
                var customerName = $(this).val();

                if (customerName.length >= 3) {
                    $.ajax({
                        type: 'GET',
                        url: '/get-options/' + customerName,
                        success: function(data) {
                            optionsContainer.empty();

                            // Append fetched options under the input field
                            if (data.options.length > 0) {
                                $.each(data.options, function(index, option) {
                                    var optionDiv = $('<div>', {
                                        class: 'option',
                                        text: option.name +
                                            "-" + option.id
                                    });

                                    optionDiv.on('click', function() {
                                        // Set the value of the input field on option click
                                        customerNameInput.val(option.name);
                                        customer_id.val(option.id)
                                        optionsContainer
                                            .empty(); // Hide options after selection
                                    });

                                    optionsContainer.append(optionDiv);
                                });
                            } else {
                                optionsContainer.append('<p>No options available.</p>');
                            }
                        }
                    });
                }
                // Make an Ajax request to fetch options based on the input field value

            });
        });
    </script>
@endsection
<style>
    #options-container {
        position: relative;
        margin-top: -1px;
        border: 1px solid #ccc;
        border-top: none;
        max-height: 150px;
        overflow-y: auto;
    }

    .option {
        padding: 8px;
        cursor: pointer;
    }

    .option:hover {
        background-color: #f0f0f0;
    }
</style>
