<div class="fixed top-0 left-0 z-40 flex hidden w-56 max-h-screen min-h-full px-3 py-4 pt-20 bg-white border-r lg:block lg:mt-0"
    id="sidebar">
    <ul class="w-full overflow-y-auto">
        <li class="mb-2">
            <a href="{{ route('homepage') }}" target="_blank" class="w-full">
                <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                    id="sidebar-client-side">
                    <div class="flex flex-row items-center justify-between py-2">
                        <div class="flex flex-row items-center">
                            <svg class="w-5 h-5 mr-2 fill-current">
                                <path
                                    d="M15.833 1.667H7.5a2.5 2.5 0 0 0-2.5 2.5V5h-.833a2.5 2.5 0 0 0-2.5 2.5v8.333a2.5 2.5 0 0 0 2.5 2.5H12.5a2.5 2.5 0 0 0 2.5-2.5V15h.833a2.5 2.5 0 0 0 2.5-2.5V4.167a2.5 2.5 0 0 0-2.5-2.5zm-2.5 14.166a.833.833 0 0 1-.833.834H4.167a.833.833 0 0 1-.834-.834V10h10v5.833zm0-7.5h-10V7.5a.833.833 0 0 1 .834-.833H12.5a.833.833 0 0 1 .833.833v.833zm3.334 4.167a.833.833 0 0 1-.834.833H15V7.5a2.502 2.502 0 0 0-.15-.833h1.817V12.5zm0-7.5h-10v-.833a.833.833 0 0 1 .833-.834h8.333a.833.833 0 0 1 .834.834V5z" />
                            </svg>
                            <span class="font-medium text-normal">Client side</span>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="flex flex-col hidden py-1 pl-6 ml-1">
                    </div>
                </div>
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admincp.dashboard') }}" class="w-full">
                <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                    id="sidebar-overview">
                    <div class="flex flex-row items-center justify-between py-2">
                        <div class="flex flex-row items-center">
                            <svg class="w-5 h-5 mr-2 fill-current">
                                <path
                                    d="M18.05 8.542l-7.5-6.667a.833.833 0 0 0-1.1 0l-7.5 6.667A.833.833 0 0 0 2.5 10h.833v7.5a.833.833 0 0 0 .834.833h11.666a.834.834 0 0 0 .834-.833V10h.833a.833.833 0 0 0 .55-1.458zm-7.217 8.125H9.167v-2.5a.833.833 0 0 1 1.666 0v2.5zm4.167 0h-2.5v-2.5a2.5 2.5 0 1 0-5 0v2.5H5V10h10v6.667zM4.692 8.333L10 3.617l5.308 4.716H4.692z" />
                            </svg>
                            <span class="font-medium text-normal">Overview</span>
                        </div>
                        <div>
                        </div>
                    </div>
                    <div class="flex flex-col hidden py-1 pl-6 ml-1">
                    </div>
                </div>
            </a>
        </li>
        @can('view admins')
            <li class="mb-2">
                <a href="{{ route('admincp.admins.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-admins">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M16.358 3.042a.833.833 0 0 0-.7-.167 6.667 6.667 0 0 1-5.183-1.058.833.833 0 0 0-.95 0 6.667 6.667 0 0 1-5.183 1.058.833.833 0 0 0-1.009.817V9.9a7.5 7.5 0 0 0 3.142 6.108l3.042 2.167a.833.833 0 0 0 .966 0l3.042-2.167A7.5 7.5 0 0 0 16.667 9.9V3.692a.833.833 0 0 0-.309-.65zM15 9.9a5.833 5.833 0 0 1-2.442 4.75L10 16.475 7.442 14.65A5.833 5.833 0 0 1 5 9.9V4.65a8.333 8.333 0 0 0 5-1.158 8.333 8.333 0 0 0 5 1.158V9.9z" />
                                </svg>
                                <span class="font-medium text-normal">Admins</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view bans')
            <li class="mb-2">
                <a href="{{ route('admincp.bans.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-bans">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M10 1.667a8.333 8.333 0 1 0 0 16.666 8.333 8.333 0 0 0 0-16.666zm0 15A6.666 6.666 0 0 1 3.333 10a6.6 6.6 0 0 1 1.409-4.083l9.341 9.341A6.6 6.6 0 0 1 10 16.667zm5.258-2.584L5.917 4.742A6.6 6.6 0 0 1 10 3.333 6.667 6.667 0 0 1 16.667 10a6.6 6.6 0 0 1-1.409 4.083z" />
                                </svg>
                                <span class="font-medium text-normal">Bans</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view faqs')
            <li class="mb-2">
                <a href="{{ route('admincp.faqs.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-admins">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M16.358 3.042a.833.833 0 0 0-.7-.167 6.667 6.667 0 0 1-5.183-1.058.833.833 0 0 0-.95 0 6.667 6.667 0 0 1-5.183 1.058.833.833 0 0 0-1.009.817V9.9a7.5 7.5 0 0 0 3.142 6.108l3.042 2.167a.833.833 0 0 0 .966 0l3.042-2.167A7.5 7.5 0 0 0 16.667 9.9V3.692a.833.833 0 0 0-.309-.65zM15 9.9a5.833 5.833 0 0 1-2.442 4.75L10 16.475 7.442 14.65A5.833 5.833 0 0 1 5 9.9V4.65a8.333 8.333 0 0 0 5-1.158 8.333 8.333 0 0 0 5 1.158V9.9z" />
                                </svg>
                                <span class="font-medium text-normal">Faqs</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view images')
            <li class="mb-2">
                <a href="{{ route('admincp.images.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-images">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M10 1.667a8.333 8.333 0 1 0 0 16.666 8.333 8.333 0 0 0 0-16.666zm0 15A6.666 6.666 0 0 1 3.333 10a6.6 6.6 0 0 1 1.409-4.083l9.341 9.341A6.6 6.6 0 0 1 10 16.667zm5.258-2.584L5.917 4.742A6.6 6.6 0 0 1 10 3.333 6.667 6.667 0 0 1 16.667 10a6.6 6.6 0 0 1-1.409 4.083z" />
                                </svg>
                                <span class="font-medium text-normal">Images</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view consumers')
            <li class="mb-2">
                <a href="{{ route('admincp.consumers.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-consumers">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M10.25 10.183a4.1 4.1 0 0 0 1.417-3.1 4.167 4.167 0 0 0-8.334 0 4.1 4.1 0 0 0 1.417 3.1A6.667 6.667 0 0 0 .833 16.25a.833.833 0 1 0 1.667 0 5 5 0 1 1 10 0 .833.833 0 1 0 1.667 0 6.666 6.666 0 0 0-3.917-6.067zm-2.75-.6a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm8.117.267A4.167 4.167 0 0 0 12.5 2.917a.833.833 0 0 0 0 1.666 2.5 2.5 0 0 1 2.5 2.5 2.499 2.499 0 0 1-1.25 2.159.834.834 0 0 0-.042 1.416l.325.217.109.058a5.834 5.834 0 0 1 3.333 5.317.833.833 0 1 0 1.667 0 7.501 7.501 0 0 0-3.525-6.4z" />
                                </svg>
                                <span class="font-medium text-normal">Consumers</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view lenders')
            <li class="mb-2">
                <a href="{{ route('admincp.lenders.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-lenders">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M7.917 8.75H10a.833.833 0 0 0 0-1.667h-.833v-.416a.833.833 0 1 0-1.667 0v.458a2.083 2.083 0 0 0 .417 4.125h.833a.417.417 0 0 1 0 .833H6.667a.833.833 0 1 0 0 1.667H7.5v.417a.833.833 0 1 0 1.667 0v-.459a2.083 2.083 0 0 0-.417-4.125h-.833a.417.417 0 0 1 0-.833zM17.5 10H15V2.5a.835.835 0 0 0-1.25-.725l-2.5 1.433-2.5-1.433a.833.833 0 0 0-.833 0l-2.5 1.433-2.5-1.433a.833.833 0 0 0-1.25.725v13.333a2.5 2.5 0 0 0 2.5 2.5h11.666a2.5 2.5 0 0 0 2.5-2.5v-5A.833.833 0 0 0 17.5 10zM4.167 16.667a.834.834 0 0 1-.834-.834V3.942L5 4.892a.9.9 0 0 0 .833 0l2.5-1.434 2.5 1.434a.9.9 0 0 0 .834 0l1.666-.95v11.891c.003.285.053.566.15.834H4.167zm12.5-.834a.834.834 0 0 1-1.667 0v-4.166h1.667v4.166z" />
                                </svg>
                                <span class="font-medium text-normal">Lenders</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view loantypes')
            <li class="mb-2">
                <a href="{{ route('admincp.loantypes.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-loantypes">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M2.5 10h5a.833.833 0 0 0 .833-.833v-5a.833.833 0 0 0-.833-.834h-5a.833.833 0 0 0-.833.834v5A.833.833 0 0 0 2.5 10zm.833-5h3.334v3.333H3.333V5zm7.5 1.667H17.5A.833.833 0 0 0 17.5 5h-6.667a.833.833 0 0 0 0 1.667zm0 8.333H2.5a.833.833 0 1 0 0 1.667h8.333a.833.833 0 1 0 0-1.667zm6.667-3.333h-15a.833.833 0 1 0 0 1.666h15a.833.833 0 0 0 0-1.666zm0-3.334h-6.667a.833.833 0 0 0 0 1.667H17.5a.833.833 0 0 0 0-1.667z" />
                                </svg>
                                <span class="font-medium text-normal">Loan types</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view sections')
            <li class="mb-2">
                <a href="{{ route('admincp.sections.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-sections">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M17.5 1.667h-15a.833.833 0 0 0-.833.833v15a.833.833 0 0 0 .833.833h15a.833.833 0 0 0 .833-.833v-15a.833.833 0 0 0-.833-.833zm-8.333 15H3.333v-3.334h5.834v3.334zm0-5H3.333V8.333h5.834v3.334zm7.5 5h-5.834v-3.334h5.834v3.334zm0-5h-5.834V8.333h5.834v3.334zm0-5H3.333V3.333h13.334v3.334z" />
                                </svg>
                                <span class="font-medium text-normal">Sections</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view settings')
            <li class="mb-2">
                <a href="{{ route('admincp.settings.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-settings">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M17.767 7.959l-1.575-.525.741-1.484a.834.834 0 0 0-.158-.95L15 3.225a.834.834 0 0 0-.958-.158l-1.484.742-.525-1.575a.834.834 0 0 0-.783-.567h-2.5a.833.833 0 0 0-.792.567l-.525 1.575-1.483-.742a.833.833 0 0 0-.95.158L3.225 5a.833.833 0 0 0-.158.959l.741 1.483-1.575.525a.833.833 0 0 0-.566.783v2.5a.833.833 0 0 0 .566.792l1.575.525-.741 1.483a.834.834 0 0 0 .158.95L5 16.775a.833.833 0 0 0 .958.159l1.484-.742.525 1.575a.834.834 0 0 0 .791.567h2.5a.834.834 0 0 0 .792-.567l.525-1.575 1.483.742a.833.833 0 0 0 .942-.159L16.775 15a.834.834 0 0 0 .158-.958l-.741-1.483 1.575-.525a.834.834 0 0 0 .566-.784v-2.5a.834.834 0 0 0-.566-.791zm-1.1 2.691l-1 .334a1.668 1.668 0 0 0-.967 2.35l.475.95-.917.916-.925-.5a1.667 1.667 0 0 0-2.325.967l-.333 1H9.35l-.333-1a1.667 1.667 0 0 0-2.35-.967l-.95.475-.917-.916.5-.925a1.667 1.667 0 0 0-.967-2.35l-1-.334v-1.3l1-.333a1.667 1.667 0 0 0 .967-2.35l-.475-.925.917-.917.925.475a1.667 1.667 0 0 0 2.35-.966l.333-1h1.3l.333 1a1.666 1.666 0 0 0 2.35.966l.95-.475.917.917-.5.925a1.667 1.667 0 0 0 .967 2.325l1 .333v1.325zM10 6.667a3.333 3.333 0 1 0 0 6.667 3.333 3.333 0 0 0 0-6.667zm0 5a1.667 1.667 0 1 1 0-3.334 1.667 1.667 0 0 1 0 3.334z" />
                                </svg>
                                <span class="font-medium text-normal">Settings</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view reviews')
            <li class="mb-2">
                <a href="{{ route('admincp.reviews.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-reviews">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M18.333 8.058a.833.833 0 00-.716-.558l-4.742-.692L10.75 2.5a.833.833 0 00-1.5 0L7.125 6.8l-4.742.7a.833.833 0 00-.675.567.833.833 0 00.209.833l3.441 3.333-.833 4.734a.834.834 0 001.208.892L10 15.633l4.25 2.234c.117.066.249.1.383.1a.834.834 0 00.78-.526.833.833 0 00.045-.466l-.833-4.733 3.442-3.334a.833.833 0 00.266-.85zm-5.125 3.334a.833.833 0 00-.241.742l.6 3.491-3.134-1.666a.833.833 0 00-.783 0l-3.133 1.666.6-3.492a.834.834 0 00-.242-.741l-2.5-2.5 3.508-.509a.833.833 0 00.634-.458L10 4.75l1.567 3.183a.832.832 0 00.633.459l3.508.508-2.5 2.492z" />
                                </svg>
                                <span class="font-medium text-normal">Reviews</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view connected urls')
            <li class="mb-2">
                <a href="{{ route('admincp.connected-urls.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="connected-urls">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 256 256">
                                    <path fill="none" d="M0 0h256v256H0z" />
                                    <path
                                        d="m132 180-31 31a24 24 0 0 1-34 0l-22-22a24 24 0 0 1 0-34l31-31M56 200l-32 32M232 24l-32 32M140 148l-20 20"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="24" />
                                    <path fill="#231f20" d="m140 148-20 20" />
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="24" d="m108 116-20 20" />
                                    <path fill="currentColor" d="m108 116-20 20" />
                                    <path
                                        d="m180 132 31-31a24 24 0 0 0 0-34l-22-22a24 24 0 0 0-34 0l-31 31M116 68l72 72M68 116l72 72"
                                        fill="none" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="24" />
                                </svg>
                                <span class="font-medium text-normal">Connected url's</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view statistics')
            <li class="mb-2">
                <a href="{{ route('admincp.statistics.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-statistics">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M17.5 16.667h-.833v-12.5a.833.833 0 1 0-1.667 0v12.5h-1.667V7.5a.833.833 0 1 0-1.666 0v9.167H10v-5.834a.833.833 0 1 0-1.667 0v5.834H6.667v-2.5a.833.833 0 1 0-1.667 0v2.5H3.333V2.5a.833.833 0 1 0-1.666 0v15a.833.833 0 0 0 .833.833h15a.833.833 0 0 0 0-1.666z" />
                                </svg>
                                <span class="font-medium text-normal">Statistics</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view visitors')
            <li class="mb-2">
                <a href="{{ route('admincp.visitors.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                        id="sidebar-visitors">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current">
                                    <path
                                        d="M13.092 10.592a5 5 0 1 0-6.184 0 8.333 8.333 0 0 0-5.183 6.816.838.838 0 1 0 1.667.184 6.667 6.667 0 0 1 13.25 0 .833.833 0 0 0 .833.741h.092a.833.833 0 0 0 .733-.916 8.334 8.334 0 0 0-5.208-6.825zM10 10a3.333 3.333 0 1 1 0-6.667A3.333 3.333 0 0 1 10 10z" />
                                </svg>
                                <span class="font-medium text-normal">Visitors</span>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="flex flex-col hidden py-1 pl-6 ml-1">
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        @can('view redirectlinks')
            <li class="mb-2">
                <a href="{{ route('admincp.redirect-links.index') }}" class="w-full">
                    <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-200 hover:text-gray-600"
                        id="sidebar-redirect-links">
                        <div class="flex flex-row items-center justify-between py-2">
                            <div class="flex flex-row items-center">
                                <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24">
                                    <path
                                        d="M4.76 10.59a1 1 0 0 0 .26-2l-1.76-.44a1 1 0 1 0-.52 1.93l1.76.47a.78.78 0 0 0 .26.04ZM8.62 5a1 1 0 0 0 1 .74.82.82 0 0 0 .26 0 1 1 0 0 0 .7-1.22l-.47-1.76a1 1 0 1 0-1.93.52Zm4.83 10A1 1 0 0 0 12 15l-3.5 3.56a2.21 2.21 0 0 1-3.06 0 2.15 2.15 0 0 1 0-3.06L9 12a1 1 0 1 0-1.41-1.41L4 14.08A4.17 4.17 0 1 0 9.92 20l3.53-3.53a1 1 0 0 0 0-1.47ZM5.18 6.59a1 1 0 0 0 .7.29 1 1 0 0 0 .71-.29 1 1 0 0 0 0-1.41L5.3 3.89A1 1 0 0 0 3.89 5.3Zm16.08 7.33-1.76-.47a1 1 0 1 0-.5 1.93l1.76.47h.26a1 1 0 0 0 .26-2ZM15.38 19a1 1 0 0 0-1.23-.7 1 1 0 0 0-.7 1.22l.47 1.76a1 1 0 0 0 1 .74 1.15 1.15 0 0 0 .26 0 1 1 0 0 0 .71-1.23Zm3.44-1.57a1 1 0 0 0-1.41 1.41l1.29 1.29a1 1 0 0 0 1.41 0 1 1 0 0 0 0-1.41ZM21.2 7a4.16 4.16 0 0 0-7.12-3l-3.53 3.56A1 1 0 1 0 12 9l3.5-3.56a2.21 2.21 0 0 1 3.06 0 2.15 2.15 0 0 1 0 3.06L15 12a1 1 0 0 0 0 1.41 1 1 0 0 0 1.41 0L20 9.92A4.19 4.19 0 0 0 21.2 7Z" />
                                </svg>
                                <span class="font-medium text-normal">Redirect links</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        @endcan
        <li class="mb-2">
            <div class="flex flex-col items-start justify-start px-2 text-gray-500 bg-white rounded hover:bg-gray-100 hover:text-gray-600"
                id="dropdown-background sidebar-statistics">
                <div class="flex flex-row items-center justify-between w-full py-2" id="dropdown-container">
                    <a href="#">
                        <div class="flex flex-row items-center">
                            <svg class="w-5 h-5 mr-2 fill-current">
                                <path
                                    d="M14.833 5.667H14v-2.5a2.5 2.5 0 0 0-2.5-2.5H3.167a2.5 2.5 0 0 0-2.5 2.5v10a.833.833 0 0 0 .516.766.833.833 0 0 0 .908-.175l2.342-2.35h1.234v1.2a2.5 2.5 0 0 0 2.5 2.5h5.766l1.975 1.984a.834.834 0 0 0 1.283-.13.833.833 0 0 0 .142-.462V8.167a2.5 2.5 0 0 0-2.5-2.5zm-9.166 2.5v1.575H4.092a.833.833 0 0 0-.592.241l-1.167 1.175V3.167a.833.833 0 0 1 .834-.834H11.5a.833.833 0 0 1 .833.834v2.5H8.167a2.5 2.5 0 0 0-2.5 2.5zm10 6.325l-.834-.834a.834.834 0 0 0-.591-.25H8.167a.833.833 0 0 1-.834-.833V8.167a.833.833 0 0 1 .834-.834h6.666a.833.833 0 0 1 .834.834v6.325z" />
                            </svg>
                            <span class="font-medium text-normal">Language</span>
                        </div>
                    </a>
                    <div>
                        <svg class="w-5 h-5 fill-current" id="dropdown-toggle">
                            <path
                                d="M9.29302 12.95L10 13.657L15.657 8L14.243 6.586L10 10.828L5.75702 6.586L4.34302 8L9.29302 12.95Z" />
                        </svg>
                    </div>
                </div>
                @php
                    $current_domain = request()->getHost();
                    $requestPath = explode('/', request()->path());
                    env('APP_ENV') == 'local' ? ($port = ':8000') : ($port = '');
                @endphp
                <div class="flex flex-col hidden py-1 pl-6 ml-1" id="dropdown">
                    @foreach (\App\Models\Admincp\Settings::where('name', 'lang')->get() as $language)
                        <a href="{{ '//' . $current_domain . $port . '/' . $language->value . '/' . $requestPath[1] . '/' . (isset($requestPath[2]) ? $requestPath[2] : '') }}"
                            class="py-1 text-gray-500 hover:text-gray-600">
                            {{ __('admincp-sidebar.' . $language->value) }}</a>
                    @endforeach
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="absolute top-0 left-0 z-30 hidden w-screen h-screen bg-black opacity-25" id="sidebar-overlay"></div>

<style>
    #dropdown-toggle,
    #dropdown-toggle_1 {
        transition: .2s;
    }

    #dropdown-toggle.toggled,
    #dropdown-toggle_1.toggled {
        transform: rotate(180deg);
        transition: .2s;
    }
</style>

<script>
    const dropdownToggle = document.getElementById("dropdown-toggle");
    const dropdownBackground = document.getElementById("dropdown-background sidebar-statistics");
    const dropdownContainer = document.getElementById("dropdown-container");
    const dropdown = document.getElementById("dropdown");

    dropdownContainer.onclick = () => {
        dropdownToggle.classList.toggle("toggled");

        dropdown.classList.toggle("hidden");
        dropdownBackground.classList.toggle("bg-gray-100");
        dropdownContainer.classList.toggle("border-b");
        dropdownContainer.classList.toggle("text-gray-600");
    };

    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const sidebarOverlay = document.getElementById("sidebar-overlay");

    sidebarToggle.onclick = () => {
        sidebar.classList.toggle("hidden");
        sidebarOverlay.classList.toggle("hidden");
        document.querySelector("body").classList.toggle("overflow-hidden");
    };

    sidebarOverlay.onclick = () => {
        sidebar.classList.toggle("hidden");
        sidebarOverlay.classList.toggle("hidden");
        document.querySelector("body").classList.toggle("overflow-hidden");
    };
</script>
