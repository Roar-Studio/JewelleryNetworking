@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/profile.css') }}?v={{ time() }}">
<style>
   #mobile-view{
        display:none;
    }
    /* .table-responsive{
        display:block;
    } */
   .custom-btn{
    font-size: 20px;
   } 
   .spinner{
      display: block;
   }
   .directory-filter{
        border-bottom: 1px solid #ddd;
   }
   .view-type{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 25px;
  }
  .view-type > div{
    min-width: 130px;
    padding: 10px 15px;
    border: 1px solid #254b5a;
    text-align: center;
    cursor: pointer;
  }
  .view-type div.active{
    background: #254b5a;
    color:#fff;
  }
  p.no-data{
    color: #333;
    padding: unset;
  }

  /* Search box styling */
  .search-wrapper {
    flex: 0 0 auto;
    margin-left: auto;
    margin-right: 20px;
  }
  .search-input {
    padding: 10px 15px;
    border: 1px solid #254b5a;
    border-radius: 5px;
    font-size: 16px;
    width: 300px;
  }
  .search-input:focus {
    outline: none;
    border-color: #1a3a47;
    box-shadow: 0 0 5px rgba(37, 75, 90, 0.3);
  }

  /* Desktop view (default) */
.table.membership-list th,
.table.membership-list td {
    white-space: nowrap;
    vertical-align: middle;
}

/* Mobile view ke liye adjust */
@media (max-width: 768px) {
    .directory-filter {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    .profile-header {
        margin-bottom: 15px;
    }
    .search-wrapper {
        margin: 15px 0;
        width: 100%;
    }
    .search-input {
        width: 100%;
    }
    .form-group {
        width: 100%;
    }
    .membership-list td:nth-child(1), /* Image column */
    .membership-list th:nth-child(1) {
        width: 10% !important;
    }
    .membership-list td:nth-child(2), /* Member Type */
    .membership-list th:nth-child(2) {
        width: 15% !important;
    }
    .membership-list td:nth-child(3), /* Name & Company */
    .membership-list th:nth-child(3) {
        width: 40% !important;
    }
    .membership-list td:nth-child(4), /* Mobile */
    .membership-list th:nth-child(4) {
        width: 30% !important;
    }
    .membership-list img.img-fluid {
        max-width: 100%;
        height: auto;
    }
    #category-div{
        width:100%;
    }
    #mobile-view{
        display:block;
    }
    /* .table-responsive{
        display:none;
    } */
}

/* Header Styling */
.profile-header {
  text-align: left;
  margin-bottom: 20px;
}

.profile-title {
  font-size: 32px;
  font-weight: 700;
  color: #1a3a47;
  margin-bottom: 5px;
}

.profile-username {
  font-size: 16px;
  color: #666;
  margin: 0;
}

/* Search and Filter Wrapper */
.search-filter-wrapper {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
  padding: 15px;
  background: #f8f9fa;
  border-radius: 8px;
  border: 1px solid #e0e0e0;
}

/* Compact Search Box */
.search-box-container {
  flex: 0 0 auto;
}

.search-input-compact {
  padding: 8px 12px;
  border: 1px solid #254b5a;
  border-radius: 5px;
  font-size: 14px;
  width: 350px;
}

.search-input-compact:focus {
  outline: none;
  border-color: #1a3a47;
  box-shadow: 0 0 5px rgba(37, 75, 90, 0.3);
}

/* Alphabet Filter */
.alphabet-filter-wrapper {
  display: flex;
  align-items: center;
  gap: 10px;
  flex: 1;
}

.filter-label {
  font-size: 14px;
  font-weight: 600;
  color: #254b5a;
  white-space: nowrap;
}

.alphabet-filter-compact {
  display: flex;
  flex-wrap: wrap;
  gap: 4px;
}

.alphabet-btn-compact {
  padding: 6px 10px;
  border: 1px solid #254b5a;
  background: white;
  color: #254b5a;
  cursor: pointer;
  font-size: 13px;
  font-weight: 500;
  transition: all 0.2s ease;
  border-radius: 4px;
  min-width: 32px;
  text-align: center;
}

.alphabet-btn-compact:hover {
  background: #e8f4f8;
  transform: translateY(-1px);
}

.alphabet-btn-compact.active {
  background: #254b5a;
  color: white;
  box-shadow: 0 2px 4px rgba(37, 75, 90, 0.3);
}

.alphabet-btn-compact[data-letter="all"] {
  min-width: 50px;
  font-weight: 600;
}

/* Mobile Responsive */
@media (max-width: 992px) {
  .search-filter-wrapper {
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
  }
  
  .search-box-container {
    width: 100%;
  }
  
  .search-input-compact {
    width: 100%;
  }
  
  .alphabet-filter-wrapper {
    width: 100%;
    flex-direction: column;
    align-items: flex-start;
  }
  
  .alphabet-filter-compact {
    width: 100%;
    justify-content: flex-start;
  }
}

@media (max-width: 576px) {
  .profile-title {
    font-size: 24px;
  }
  
  .alphabet-btn-compact {
    padding: 5px 8px;
    font-size: 12px;
    min-width: 28px;
  }
  
  .alphabet-btn-compact[data-letter="all"] {
    min-width: 45px;
  }

  #category-div{
        width:100%;
    }
}

/* Remove old CSS */
.directory-filter {
  display: none; /* Remove old filter section */
}

.search-wrapper {
  display: none; /* Remove old search */
}

.form-group {
  display: none; /* Remove old sort dropdown */
}
.alphabet-filter-wrapper {
  display: flex;
  align-items: center;
  justify-content: flex-end; /* right align */
  gap: 8px;
}

.alphabet-dropdown {
  width: 120px; 
  border : 1px solid black;
}
.directory-header {
    margin-bottom: 1px;
}
#category-div{
    border:1px solid black;
    border-radius:5px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
      background-color:#254b5a !important;
      color: white !important;/* Adjust text color if needed */
  }
.select2-container--default .select2-results__option[aria-selected=true] {
    background-color: #254b5a !important;
}
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/profile_header.webp') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/profile_mobile_banner.svg') }}" class="d-block w-100 mobile_view" alt="carousel image">
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <article class="profile-card mx-auto">
            <div class="profile-image-wrapper position-relative">
                <img
                  src="{{ asset('new_ui/assets/images/dummy-user.webp') }}"
                  alt="Profile picture of Prernaa Makhariaa"
                  class="profile-image img-fluid"
                />
            </div>
            <section class="profile-details">
                <div class="profile-info">
                    <h2 class="profile-name"></h2>
                    <p class="profile-phone"></p>
                </div>
            </section>
        </article>
      </div>
    </div>
</div>

<section class="container profile-container mt-2">
    <!-- Header -->
    <header class="profile-header mb-1">
        <h1 class="profile-title">Membership Directory</h1>
        <p class="profile-username">Standard Plan</p>
    </header>

    <!-- Search and Alphabet Filter Row -->
    <section class="row mb-3">
      <div class="col-12">
        <div class="search-filter-wrapper">
          <!-- Search Box -->
          <div class="search-box-container">
            <input 
              type="text" 
              class="search-input-compact" 
              id="memberSearch" 
              placeholder="Search by name or mobile..."
            />
          </div>
          

          <!-- Alphabet Filter -->
          <div class="alphabet-filter-wrapper">
            <span class="filter-label">Filter by:</span>
            <select class="form-select select2 alphabet-dropdown" id="alphabetFilter">
                <option value="all">All</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
                <option value="I">I</option>
                <option value="J">J</option>
                <option value="K">K</option>
                <option value="L">L</option>
                <option value="M">M</option>
                <option value="N">N</option>
                <option value="O">O</option>
                <option value="P">P</option>
                <option value="Q">Q</option>
                <option value="R">R</option>
                <option value="S">S</option>
                <option value="T">T</option>
                <option value="U">U</option>
                <option value="V">V</option>
                <option value="W">W</option>
                <option value="X">X</option>
                <option value="Y">Y</option>
                <option value="Z">Z</option>
            </select>
        </div>        
        <div class="col-3" id="category-div"> 
            <select class="form-select select2" id="categoryFilter" name="category_id" tabindex="5" data-placeholder="Category Type" style="border : 1px solid black;">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M16.9875 4.3625C16.8937 4.3625 16.8 4.36562 16.7062 4.375C15.975 4.45312 15.2937 4.78438 14.7812 5.3125L13.6156 6.47812C13.1906 5.12187 11.875 4.24687 10.4594 4.375C9.725 4.45312 9.04375 4.78438 8.52813 5.3125L7.5 6.35625V1.25C7.5 0.559375 6.94063 0 6.25 0H1.25C0.559375 0 0 0.559375 0 1.25V17.5C0 18.8813 1.11875 20 2.5 20H17.5C18.8813 20 20 18.8813 20 17.5V7.39375C20.0063 5.725 18.6562 4.36875 16.9875 4.3625ZM2.5 2.5H5V7.77188L2.5 10.1906V2.5Z" fill="#999999"/>
            </svg> --}}
        </div>

        </div>
      </div>
    </section>

    <!-- View Type Toggle -->
    <section class="d-flex d-flex justify-content-center">
        <div class="view-type">
            <div class="active" id="list-view">List</div>
            <div id="grid-view">Grid</div>
        </div>
    </section>

    <!-- Filter Buttons -->
    <div class="row mb-3">
        <div class="col-md-3" style="display: none;">
          <button class="btn custom-btn filter-plan active-membership-btn" data-plan_id="all">All Members</button>
        </div>
        <div class="col-md-3" style="display: none;">
          <button class="btn custom-btn filter-plan inactive-membership-btn" data-plan_id="3">Premium</button>
        </div>
        <div class="col-md-3" style="display: none;">
          <button class="btn custom-btn filter-plan inactive-membership-btn" data-plan_id="2">Standard</button>
        </div>
        <div class="col-md-3" style="display: none;">
          <button class="btn custom-btn filter-plan inactive-membership-btn" data-plan_id="1">Free</button>
        </div>
    </div>

    <!-- Grid View -->
    <div class="membership-grid" style="display: none;">
    </div>

    <!-- List View -->
    {{-- <div class="table-responsive11"> --}}
    
    <div class="table-responsive">
        <table class="table table-striped table-hover membership-list">
            <thead>
                <tr>
                    <th style="width: 10%;">Image</th>
                    <th style="width: 15%;">Member Type</th>
                    <th style="width: 35%;">Name & Company</th>
                    <th style="width: 35%;">Mobile</th>
                    <th style="width: 5%;">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- JS will append rows here -->
            </tbody>
        </table>
    </div>

    <!-- Spinner -->
    <div class="spinner text-center my-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="text-center mt-2">
        <button class="load-more-btn btn btn-primary custom-btn">Load more</button>
    </div>
</section>

<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script>
    let planType = '';       
    let alphabetFilter = ''; 
    let searchQuery = '';    
    let offset = 0;          
    const limit = 10;        
    const loadMoreLimit = 5; 
    let isFetching = false;  
    let searchTimeout = null; 
    let categoryFilter = '';
    
    function fetchBasicDetails() {
        try {
            window.axiosApiClient.get('/get-basic-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken()}
            })
            .then(function (response) {
                if(response.data.status == 'success') {
                    const customer = response.data.data;
                    var basicForm = $('#basicForm');
                    
                    $('.profile-name').text(customer.first_name + ' ' + customer.last_name);
                    $('.profile-phone').text(customer.mobile_no_cc + ' ' + customer.mobile_no);
                    $('.profile-username').text(customer.username);
                    if(customer.profile_photo) {
                        $('.profile-image').attr('src', `/storage/${customer.profile_photo}`);
                    }
                }
            })
            .catch(function (error) {
                console.error("Error fetching basic details:", error);
            });
            
        } catch (error) {
            console.error('Error fetching customer data:', error);
        }
    }

    function fetchMemberships(isLoadMore = false) {
        if (isFetching) return;

        isFetching = true;
        $('.spinner').show();
        $('.load-more-btn').prop('disabled', true);

        const payload = {
            plan_type: planType,
            alphabet: alphabetFilter,
            search: searchQuery,
            offset: offset,
            limit: isLoadMore ? loadMoreLimit : limit,
            category : categoryFilter
        };

        console.log('Sending payload:', payload); // Debug log

        window.axiosApiClient.post('getMembersData', payload, {
            headers: { 'Authorization': 'Bearer ' + getAuthToken() }
        }).then(function (response) {
            const members = response.data.data.members || [];
            updatePlanButtons(response.data.data.user_plan);
            
            if (!isLoadMore) {
                $('.membership-grid').empty();
                $('.membership-list tbody').empty();
                $('.membership-list thead').show();
                offset = 0;
            }
            
            if (members.length) {
                members.forEach(member => {
                    $('.membership-grid').append(renderMemberBox(member, 'grid'));
                    $('.membership-list tbody').append(renderMemberBox(member, 'list'));                    
                });
                offset += members.length;
            }
            else if(offset == 0){
                const noDataMsg = searchQuery || alphabetFilter
                    ? '<p class="text-center no-data">No members found matching your criteria.</p>'
                    : '<p class="text-center no-data">The member directory is not available for free accounts. <br/>Please upgrade your plan to access it. <br/> <br/> <a class="custom-btn btn btn-primary" href="/membership">Subscribe now</a>.</p>';
                
                $('.membership-grid').append(noDataMsg);
                $('.membership-list thead').hide();
                $('.membership-list tbody').append(`<tr><td colspan="5">${noDataMsg}</td></tr>`);
            }

            if (members.length < (isLoadMore ? loadMoreLimit : limit)) {
                $('.load-more-btn').hide();
            } else {
                $('.load-more-btn').show().prop('disabled', false);
            }

            $('.spinner').hide();
            isFetching = false;
        }).catch(function (error) {
            console.error('Fetch error:', error);
            $('.spinner').hide();
            $('.load-more-btn').prop('disabled', false);
            isFetching = false;
        });
    }

    function renderMemberBox(member, $view_type) {
        if($view_type == 'grid'){
            /* return `
            <div class="row directory-box mt-2">
                <div class="col-md-2 p-0 position-relative">
                    <a href="/member/${member.id}"><img src="${member.image_url}" class="d-block" alt="Directory image"></a>
                    <label class="position-absolute start-0 top-0 membership-chip">${member.plan_label}</label>
                </div>
                <div class="col-md-6 directory-info">
                    <header class="directory-header mt-1">
                        <h1 class="directory-title">${member.name}</h1>
                        <p class="directory-username">${member.company_name || '-'}</p>
                    </header>
                    <header class="directory-header">
                        <h1 class="directory-title">${member.mobile_no}</h1>
                    </header>
                </div>
                <div class="col-md-4">
                    
                </div>
            </div>`; */

            return `
                <div class="card mb-1" style="max-height: 150px; overflow: hidden;">
                <!-- Added 'flex-nowrap' to ensure they stay on one line on mobile -->
                <div class="row g-0 flex-nowrap"> 
                    
                    <!-- Changed col-md-4 to col-4 (or a fixed width) -->
                    <div class="col-4" style="max-width: 120px;">
                        <a href="/member/${member.id}">
                            <img src="${member.image_url}" alt="Directory image" 
                                class="img-fluid rounded-start"
                                style="height: 100%; object-fit: cover;">
                        </a>
                    </div>

                    <!-- Changed col-md-8 to col-8 -->
                    <div class="col-8">
                        <div class="card-body p-1"> <!-- Reduced padding for mobile -->
                            
                            <h5 class="card-title mb-0 font-bold text-black">${member.name}</h5>
                            <p class="card-text mb-0 text-black">${member.company_name || '-'}</p>
                            <p class="card-text text-black"><span style="background-color: #f0f0f0; padding: 2px 5px; border-radius: 4px;"><small>${member.plan_label}</small></span><small> ${member.mobile_no}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            `;
            
            return `
                    <div class="row directory-box mt-2 g-0 align-items-center d-flex flex-column flex-md-row text-center text-md-start" id="grid-div-border">
    
                    <!-- Image Section -->
                    <div class="col-auto p-0 position-relative grid-div mx-auto mx-md-0 align-self-start">
                        <a href="/member/${member.id}">
                            <img src="${member.image_url}" alt="Directory image" 
                                style="display: block; height: 100%; object-fit: contain; object-position: left top;">
                                <!--width: 150px; height: 150px; object-fit: cover; -->
                        </a>
                        <label class="position-absolute start-0 top-0 membership-chip text-white">
                            <!--px-3 py-1 bg-dark-->
                            ${member.plan_label}
                        </label>
                    </div>

                    <!-- Info Section -->
                    <!-- ps-md-4 adds padding only on desktop; mt-3 adds spacing only on mobile -->
                    <div class="col-md-8 d-flex flex-column justify-content-center ps-md-4 mt-1 mt-md-0 directory-info">
                        <header class="directory-header">
                            <h1 class="directory-title mt-1">
                                ${member.name}
                            </h1>
                            <p class="directory-username">
                                ${member.company_name || '-'}
                            </p>
                        </header>
                        <header class="directory-header">
                            <h1 class="directory-title">
                                ${member.mobile_no}
                            </h1>
                        </header>
                    </div>
                </div>
            `;
        }
        else{
            return `
            <tr>
                <td style="width: 10%; position: relative;">
                    <a href="/member/${member.id}"><img src="${member.image_url}" class="img-fluid rounded" alt="Directory image"></a>
                </td>
                <td style="width: 15%;">
                    <span class="membership-chip">${member.plan_label}</span>
                </td>
                <td style="width: 35%;">
                    <strong>${member.name}</strong><br>
                    <small class="text-muted">${member.company_name || '-'}</small>
                </td>
                <td style="width: 35%;padding: 0px;">${member.mobile_no}</td>
                <td style="width: 5%;">
                    <a href="/member/${member.id}">
                        <img src="{{ asset('new_ui/assets/images/eye-directory.svg') }}" class="directory-icon" alt="View">
                    </a>
                </td>
            </tr>`;
        }
    }
                    
    function updatePlanButtons(planType) {
        $('.filter-plan').closest('div').hide();
        if(planType == 1){
            $('.filter-plan').closest('div').remove();
        }
        else{
            $('.filter-plan').each(function () {
                const planId = $(this).data('plan_id');
                if(planId){
                    if (planId <= planType || planId == 'all') {
                        $(this).closest('div').show();
                    }
                    else{
                        $(this).closest('div').remove();
                    }
                }
            });
        }
    }

    

    $(document).ready(function () {
        fetchBasicDetails();
        fetchMemberships();

        // Search functionality - UPDATED ID
        $('#memberSearch').on('input', function () {
            clearTimeout(searchTimeout);
            const value = $(this).val().trim();
            
            searchTimeout = setTimeout(function() {
                searchQuery = value;
                offset = 0;
                console.log('Search query:', searchQuery); // Debug
                fetchMemberships(false);
            }, 500);
        });

        // Alphabet filter dropdown
        $('#alphabetFilter').on('change', function () {
            const letter = $(this).val();
            alphabetFilter = letter === 'all' ? '' : letter;
            offset = 0;

            console.log('Alphabet filter:', alphabetFilter); // Debug log
            fetchMemberships(false);
        });


        // Plan filter buttons
        $('.filter-plan').click(function () {
            $('.filter-plan').removeClass('active-membership-btn').addClass('inactive-membership-btn');
            $(this).addClass('active-membership-btn').removeClass('inactive-membership-btn');

            const text = $(this).text().trim().toLowerCase();
            if (text === 'free') planType = '1';
            else if (text === 'standard') planType = '2';
            else if (text === 'premium') planType = '3';
            else planType = '';
            offset = 0;

            fetchMemberships(false);
        });

        // View type toggle
        $('.view-type div').on('click', function () {
            $('.view-type div').removeClass('active');
            $(this).addClass('active');

            if ($(this).text().trim() == 'List') {
                $('.membership-list').show();
                $('.membership-grid').hide();
                document.querySelector('.table-responsive').style.display = 'block';
            } else {
                $('.membership-list').hide();
                $('.membership-grid').show();
            }
        });

        // Load more button
        $('.load-more-btn').click(function () {
            fetchMemberships(true);
        });

        // Category  filter dropdown
        $('#categoryFilter').on('change', function () {
            const category = $(this).val();
            categoryFilter = category;
            offset = 0;

            console.log('Category filter:', categoryFilter); // Debug log
            fetchMemberships(false);
        });
        
        const mobileQuery = window.matchMedia("(max-width: 768px)");
        mobileQuery.addEventListener("change",function(e){
            if (e.matches) {
                // MOBILE: Screen is 768px or less                
                $('#grid-view').addClass('active');
                element = document.querySelector('#list-view');
                element.classList.remove('active');
                document.querySelector('.table-responsive').style.display = 'none';
                document.querySelector('.membership-grid').style.display='block';
            } else {                
                // DESKTOP: Screen is wider than 768px
                $('#list-view').addClass('active');
                element = document.querySelector('#grid-view');
                element.classList.remove('active');                
                document.querySelector('.membership-grid').style.display='none';
                document.querySelector('.table-responsive').style.display = 'block';
                document.querySelector('.membership-list').style.display = 'block';
                
            }
           
        });
        const width = window.innerWidth;
        const height = window.innerHeight;
        // console.log(`Page loaded at: ${width}x${height}`);

        if (width < 768) {            
            // alert("Mobile layout detected");
            $('#grid-view').addClass('active');
            element = document.querySelector('#list-view');
            element.classList.remove('active');
            document.querySelector('.table-responsive').style.display = 'none';
            document.querySelector('.membership-grid').style.display='block';
        }else{            
            document.querySelector('.table-responsive').style.display = 'block';
        }

    });
</script>

@endsection