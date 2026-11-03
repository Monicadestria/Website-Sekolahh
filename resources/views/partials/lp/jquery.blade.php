@section('js')    
<script>
    // URL declaration
    const slug = "<?= $slug ?>";
    const protocol = window.location.protocol;
    const hostname = window.location.hostname;
    const port = window.location.port ? `:${window.location.port}` : '';
    const domain = `${protocol}//${hostname}${port}`;
    const urlNow = window.location.href;

    // Pagination declaration
    let currentPage = "<?= $datas->currentPage() ?>"
    const path = "<?= $datas->path() ?>"
    let total = "<?= $datas->total() ?>"
    let lastPage = "<?= $datas->lastPage() ?>"
    let perPage = "<?= $datas->perPage() ?>"
    let queryData = {}
    
    // data for restore to default
    const data_before = @json($datas);
    let dataForRestore = data_before.data

    $(document).on('submit', '#search_form', function(e){
        e.preventDefault()
    });

    $(document).on('input', '#s_paging', function(){
        if($(this).val() != 10) {
            queryData = {
                'name' : 's_paging',
                's_paging' : $(this).val(),
            }
            s_ajax(window.location.href, queryData);
        } else {
            lastPage = "<?= $datas->lastPage() ?>"
            perPage = "<?= $datas->perPage() ?>"
            dataForRestore = data_before.data;

            itemPage(data_before.data);
            paginateRestore()
        }
    });

    $(document).on('input', '#s_category', function(){
        if($(this).val() != 'semua') {
            queryData = {
                'name' : 's_category',
                's_category' : $(this).val(),
            }
            s_ajax(window.location.href, queryData);
        } else {
            dataForRestore = data_before.data;

            itemPage(data_before.data);
        }
    });

    $(document).on('input', '#s_title', function() {
        if($(this).val().length > 0 ) {
            queryData = {
                's_title' : $(this).val(),
                's_paging' : perPage,
            }
            s_ajax(window.location.href, queryData);
        } else {
            itemPage(dataForRestore)
        }
    });

    // function _data_before(dataForRestore, lastPageBefore) {
    //     $('#container').html('');

    //     dataForRestore.forEach(function(item) {
    //         const itemUrl = `${domain}/${slug}/galery/gambar/${item.id}`;
    //         const imageUrl = `${domain}/storage/galery/${item.photo}`;
    //         const itemHtml = `<a class="col-md-2 nav-link shadow p-3 rounded-3 me-md-3 mb-md-3" href="${itemUrl}">
    //             <img class="img-fluid w-100 rounded-3" src="${imageUrl}">
    //             <hr>
    //             <p class="fs-6 m-0 p-0">${item.title}</p>
    //         </a>`;

    //         $('#container').append(itemHtml);

    //         // Pagination
    //         let response_link = [
    //             'prev'
    //         ];

    //         for (let index = 0; index < lastPageBefore; index++) {
    //             response_link.push(
    //                 {'label' : index+1}
    //             )
    //         }
            
    //         response_link.push('next');
    //         _paginator(response_link);
    //     });
    // }

    function s_ajax(url, queryData) {
        $.ajax({
            url: url,
            type: "GET",
            data: queryData,
            success: function (response) {
                if(response.data.length > 0) {
                    
                    itemPage(response.data);

                    if(queryData.name == 's_paging') {
                        perPage = response.per_page
                        total = response.total
                        lastPage = response.last_page
                        dataForRestore = response.data

                        const response_link = response.links;
                        _paginator(response_link);
                        
                    }

                    currentPage = response.current_page
                    check_page(currentPage);

                } else {
                    // $('#container').html('<img class="img-fluid w-25 mx-auto py-5" src="https://www.blackhillsinfosec.com/wp-content/uploads/2016/07/66619265.jpg">');

                    $('#container').html('<p class="text-light text-center my-5 h5">(Belum ada data)</p>');
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }


    // Pagination
    function _paginator(response) {
        $('#paginator').html('');
                    
        let item_paging =  [];
        response.forEach(function(component, index) {
            if(index > 0 && index < response.length - 1) {
                if(index == 1) {
                    item_paging +=
                    `<li class="page-item" aria-current="page">
                        <a class="page-link item_${component.label} active item_paginator" href="http://127.0.0.1:8000/vetencode-school/galery/gambar?page${component.label}" data-page="${component.label}">${component.label}</a>
                    </li>`;
                } else {
                    item_paging += 
                    `<li class="page-item" aria-current="page">
                        <a class="page-link item_${component.label} item_paginator" href="http://127.0.0.1:8000/vetencode-school/galery/gambar?page${component.label}" data-page="${component.label}">${component.label}</a>
                    </li>`;
                }
            }
        });

        const paginatorHtml =
        `<nav aria-label="Pagination">
            <ul class="pagination justify-content-end px-3">
            <li class="page-item">
                <a class="page-link" id="previous_paginator" href="#" rel="prev" aria-label="Sebelumnya">Sebelumnya</a>
            </li>`
            +
            item_paging
            +
            `<li class="page-item">
                <a class="page-link" id="next_paginator" href="#" rel="next" aria-label="Selanjutnya">Selanjutnya</a>
            </li>
            </ul>
        </nav>`;

        $('#paginator').append(paginatorHtml);
    }

    $(document).on('click', '#previous_paginator', function(e) {
        e.preventDefault();

        const item_page = $('.active').data('page') - 1;
        const class_item = '.item_' + item_page;
        const queryData = {
            'page' : item_page,
            's_paging' : perPage
        }

        $('.active').removeClass('active');
        $(class_item).addClass('active');

        s_ajax(path, queryData);
    });

    $(document).on('click', '.item_paginator', function(e) {
        e.preventDefault();

        const item_page = $(this).data('page');
        const class_item = '.item_' + item_page;
        const queryData = {
            'page' : item_page,
            's_paging' : perPage
        }

        $('.active').removeClass('active');
        $(class_item).addClass('active');
        
        s_ajax(path, queryData);
    });

    $(document).on('click', '#next_paginator', function(e) {
        e.preventDefault();

        const item_page = $('.active').data('page') + 1;
        const class_item = '.item_' + item_page;
        const queryData = {
            'page' : item_page,
            's_paging' : perPage
        }

        $('.active').removeClass('active');
        $(class_item).addClass('active');

        s_ajax(path, queryData);
    });

    function check_page(currentPage) {   
        if(currentPage == 1) {
            $('#previous_paginator').addClass('disabled');
            $('#next_paginator').removeClass('disabled');
        } else if(currentPage == lastPage) {
            $('#next_paginator').addClass('disabled');
            $('#previous_paginator').removeClass('disabled');
        } else {
            $('#next_paginator').removeClass('disabled');
            $('#previous_paginator').removeClass('disabled');
        }
    }

    function itemPage(responseData) {
        let gambarUrl = domain +'/'+ slug + '/galery/gambar';
        let videoUrl = domain +'/'+ slug + '/galery/video';
        let stafUrl = domain +'/'+ slug + '/staff';
        let beritaUrl = domain +'/'+ slug + '/berita';
        let itemHtml = '';

        $('#container').html('');

        responseData.forEach(function(item) {
            if(urlNow == gambarUrl) {
                const itemUrl = `${domain}/${slug}/galery/gambar/${item.id}`;
                const imageUrl = `${domain}/storage/galery/${item.photo}`;

                itemHtml = `<a class="col-md-2 nav-link shadow p-3 rounded-3 me-md-3 mb-md-3" href="${itemUrl}">
                    <img class="img-fluid w-100 rounded-3 lp_image" src="${imageUrl}">
                    <hr>
                    <p class="fs-6 m-0 p-0">${item.title}</p>
                </a>`;
            } else if (urlNow == videoUrl) {
                const itemUrl = `${domain}/${slug}/galery/video/${item.id}`;
                let videoUrl = item.video.split(/[/]/);
                videoUrl = `https://www.youtube.com/embed/${videoUrl['3']}`                

                itemHtml = 
                `<a class="col-md-2 shadow p-3 rounded-3 me-md-3 mb-md-3 text-decoration-none" href="${itemUrl}">
                    <iframe class="w-100 rounded-3" src="${videoUrl}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <hr class="">
                    <p class="fs-6 m-0 p-0">${item.title}</p>
                </a>`;
            } else if(urlNow == stafUrl) {
                const imageUrl = `${domain}/storage/staff/${item.photo}`;

                itemHtml = `<div class="col-md-2 nav-link shadow p-3 rounded-3 me-md-3 mb-md-3">
                    <img class="img-fluid w-100 rounded-3 lp_image" src="${imageUrl}">
                    <hr>
                    <p class="fs-6 m-0 p-0">${item.name}</p>
                    <p class="fs-6 m-0 p-0">NIP.${item.nip}</p>
                </div>`;
            } else if(urlNow == beritaUrl) {
                const itemUrl = `${domain}/${slug}/berita/detail/${item.id}`;
                const imageUrl = `${domain}/storage/berita/${item.photo}`;
                const date = moment(item.created_at).format('DD MMMM YYYY');

                itemHtml = `<div class="col-6 news-item mb-4" data-title="${item.title}">
                            <div class="d-flex">
                                <div class="image">
                                    <a href="${itemUrl}">
                                        <img src="${imageUrl}" width="100px" class="me-3" style="object-fit: cover; height: 100px" />
                                    </a>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                  <p><a href="${itemUrl}" class="text-decoration-none text-dark">${item.title}</a></p>
                                  <p>${date}</p>
                                </div>
                            </div>
                        </div>`;
            }

            
            $('#container').append(itemHtml);
        });
    }

    function paginateRestore() {
        let response_link = [
            'prev'
        ];

        for (let index = 0; index < lastPage; index++) {
            response_link.push(
                {'label' : index+1}
            )
        }
        
        response_link.push('next');
        _paginator(response_link);
    }
    
</script>
@endsection
