const id_el_list = "#product-list";

function getDataOnEnter(event) {
    if (event.keyCode === 13) {
        getData(1);
    }
}

function getData(toPage = 1) {
    const url = baseUrl + '/api/laptop';

    if (toPage) {
        $("[name='_page']").val(toPage);
    }

    const payload = {
        _limit: 8,
        _page: toPage
    };

    // Include filters from form elements
    $("._filter").each(function () {
        payload[$(this).attr("name")] = $(this).val();
    });

    // Fetch data
    axios.get(url, { params: payload, headers: apiHeaders })
        .then(response => {
            console.log("[DATA] response:", response.data);

            let template = '';

            // Render product items
            (response.data.products).forEach(item => {
                template += `
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-product-item text-center">
                            <div class="products-images">
                                <a href="/laptop/${item.id}" class="product-thumbnail">
                                    <img src="/${item.image}" alt="Product Image" height="300" />
                                </a>
                            </div>
                            <div class="product-actions">
                                <a href="/laptop/${item.id}">
                                    <i class="p-icon icon-plus"></i>
                                    <span class="tool-tip">Quick View</span>
                                </a>
                                <a href="#">
                                    <i class="p-icon icon-bag2"></i>
                                    <span class="tool-tip">Add to cart</span>
                                </a>
                            </div>
                            <div class="product-content">
                                <h6 class="product-title">
                                    <a href="/laptop/${item.id}">${item.name}</a>
                                </h6>
                                <div class="product-price">
                                    <span class="new-price">IDR ${parseFloat(item.price).toLocaleString()}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $(id_el_list).html(template);

            // Update product count indicators
            $("#products_count_start").html(response.data.products_count_start);
            $("#products_count_end").html(response.data.products_count_end);
            $("#products_count_total").html(response.data.products_count_total);

            template = '';
            // Pagination
            let max_page = Math.ceil(response.data.products_count_total / response.data.filter._limit);
            let current_page = response.data.filter._page;

            // If not on first page, show "Min Page"
            if (current_page != 1) {
                template += `
                    <li>
                        <a class="prev page-numbers" onclick="getData(1)">
                            <i class="icon-chevron-left"></i>&nbsp;&nbsp;&nbsp;Min Page
                        </a>
                    </li>
                `;
            }

            // Previous page
            if (current_page > 1) {
                template += `
                    <li>
                        <a class="page-numbers" onclick="getData(${current_page - 1})">
                            ${current_page - 1}
                        </a>
                    </li>
                `;
            }

            // Current page
            template += `
                <li>
                    <a class="current text-white page-numbers" onclick="getData(${current_page})">
                        ${current_page}
                    </a>
                </li>
            `;

            if(response.data.filter._page < max_page){
                template += `
                    <li>
                        <a class="page-numbers" onclick="getData(`+(response.data.filter._page+1)+`)">
                            `+(response.data.filter._page+1)+`
                        </a>
                    </li>
                `;
            }

            if(response.data.filter._page+1 < max_page){
                template += `
                    <li>
                        <a class="page-numbers" onclick="getData(`+(response.data.filter._page+2)+`)">
                            `+(response.data.filter._page+2)+`
                        </a>
                    </li>
                `;
            }

            if(response.data.filter._page < max_page){
                template += `
                    <li>
                        <a class="next page-numbers" onclick="getData(`+max_page+`)">
                            Max Page<i class="icon-chevron-right"></i>
                        </a>
                    </li>
                `;
            }

            $("#product-list-pagination").html(template);
            $("[name='_page']").val(response.data.filter._page);

            // END--- pagination
        })
        .catch(error => {
            console.log('[ERROR] response..',error);
            if(error.code == "ERR_BAD_REQUEST"){
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Waah...",
                    html: "Produk-produk yang Anda cari tidak ditemukan",
                    showConfirmButton: false,
                    timer: 5000
                });
            }else{
                Swal.fire({
                    icon: "error",
                    width: 600,
                    title: "Error",
                    html: error.message,
                    confirmButtonText: 'Ya',
                });
            }
        });
}

$(function () {
    getData();
});
