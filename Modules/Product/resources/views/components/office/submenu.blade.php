   <nav class="navbar border-bottom navbar-expand-md navbar-light bg-light mb-3 rounded p-0">
       <!-- The whole future lies in uncertainty: live immediately. - Seneca -->
       <div class="container-fluid px-3">
           <!-- Go-back button -->
           @if (!request()->routeIs(['office.product.index', 'office.product.edit']))
               <a class="navbar-brand text-success" href="{{ route('office.product.index') }}" title="Go back"
                   data-bs-toggle="tooltip">
                   <i class="fas fa-arrow-left"></i>
               </a>
           @elseif (request()->routeIs(['office.product.edit']))
               <a class="navbar-brand text-success" href="{{ route('office.product.show', $product->id) }}" title="Go back"
                   data-bs-toggle="tooltip">
                   <i class="fas fa-arrow-left"></i>
               </a>
           @else
               <a class="navbar-brand text-success" title="" data-bs-toggle="tooltip">
                   <i class="fas fa-gift"></i>
               </a>
           @endif

           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sub-menu"
               aria-controls="sub-menu" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>

           <div class="justify-content-end navbar-collapse collapse" id="sub-menu">
               <ul class="navbar-nav _ms-auto mb-lg-0 mb-2">
                   @if (request()->routeIs(['office.product.show']))
                       @can('products.variants.create')
                           <li class="nav-item" title="Add Variant" data-bs-toggle="tooltip">
                               <a class="border-end nav-link" href="javascript://#variant-modal" data-bs-toggle="modal"
                                   data-bs-target="#variant-modal">
                                   <i class="fas fa-plus-circle"></i>
                                   Add Variant
                               </a>
                           </li>

                           @push('modals')
                               <livewire:product::office.variant-modal :product="$product ?? null" />
                           @endpush
                       @endcan

                       @can('products.update')
                           <li class="nav-item" title="Edit" data-bs-toggle="tooltip">
                               <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#product-modal">
                                   <i class="fas fa-edit"></i>
                                   Edit
                               </a>
                           </li>

                           @push('modals')
                               <livewire:product::office.product-modal :product="$product ?? null" />
                           @endpush
                       @endcan

                       @canany(['products.create', 'products.delete'])
                           <li class="nav-item dropdown">
                               <a class="nav-link dropdown-toggle" href="javascript://" id="sub-menu-actions" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                   <i class="fas fa-cog"></i>
                                   Actions
                               </a>
                               <ul class="dropdown-menu" aria-labelledby="sub-menu-actions">
                                   @can('products.create')
                                       <li><a class="dropdown-item" href="javascript://copy">Duplicate</a></li>
                                   @endcan
                                   @can('products.delete')
                                       <li>
                                           <hr class="dropdown-divider">
                                       </li>
                                       <li>
                                           <a class="dropdown-item"
                                               href="{{ route('office.product.destroy', $product->id) }}">Delete</a>
                                       </li>
                                   @endcan
                               </ul>
                           </li>
                       @endcanany
                   @elseif(request()->routeIs(['office.product.index']))
                       @can('products.create')
                           <li class="nav-item" title="Add Product" data-bs-toggle="tooltip">
                               <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#product-modal">
                                   <i class="fas fa-plus-circle me-1"></i> Add Product
                               </a>
                           </li>

                           @push('modals')
                               <livewire:product::office.product-modal :product="$product ?? null" />
                           @endpush
                       @endcan
                   @endif
               </ul>
           </div>
       </div>
   </nav>
