@extends('layouts.app')

@if ($name = \App\Models\Admincp\Settings::where('name', 'name')->first())
    @section('title', 'Add a Faq | ' . $name->value)
@else
    @section('title', 'Add a Faq | Goodday.finance')
@endif

@section('content')
    <div class="flex flex-col w-full min-h-screen pt-16 bg-gray-100 lg:pl-56">
        <!-- Header -->
        @include('admincp.components.header')
        <!-- Main content -->
        <!-- Info box -->
        @include('admincp.components.infobox')
        <!-- End info box -->
        <div class="flex flex-row flex-auto h-full">
            <!-- Sidebar -->
            @include('admincp.components.sidebar')
            <!-- Container -->
            <div class="flex flex-col items-start justify-start w-full min-h-full p-4 bg-transparent">
                <div class="flex justify-between w-full mb-4">
                    <h1 class="text-2xl font-medium text-gray-800">Add a new Faq</h1>
                </div>
                <div class="w-full p-4 bg-white rounded">
                    <h2 class="text-lg font-medium text-gray-800">Main information</h2>
                    <div class="flex items-center justify-start my-4" id="Faq-image-container">
                        <img id="Faq-image" class="object-contain max-w-full max-h-full">
                    </div>
                    <form action="{{ route('admincp.faqs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="text-lg font-medium text-gray-800">Question*</h2>
                        <div class="relative flex w-full mt-2 mb-6">
                            <textarea
                                class="w-full overflow-y-hidden text-gray-800 transition-all duration-200 border-gray-300 rounded resize-none focus:ring-primary-500 focus:border-primary-500"
                                id="auto_expand" name="question" placeholder="Faq's question" maxlength="1000" required></textarea>
                        </div>
                        <h2 class="text-lg font-medium text-gray-800">Answer*</h2>
                        <div class="flex w-full mt-2 mb-6">
                            <label class="w-full">
                                <textarea class="w-full p-2 border-gray-300 rounded-lg resize-y" name="answer" placeholder="Faq's answer"
                                    maxlength="1000" id="answer" required></textarea>
                            </label>
                            <script>
                                CKEDITOR.replace('answer', {
                                    scayt_autoStartup: false,
                                    enterMode: CKEDITOR.ENTER_BR,
                                    forcePasteAsPlainText: true,
                                    forceSimpleAmpersand: true,
                                    entities: false,
                                    basicEntities: false,
                                    entities_greek: false,
                                    entities_latin: false,
                                    toolbarCanCollapse: false,
                                });
                            </script>
                        </div>
                        <h2 class="text-lg font-medium text-gray-800">Topic</h2>
                        <div class="flex w-full mt-2 mb-6">
                            <label class="w-full">
                                <textarea class="w-full p-2 border-gray-300 rounded-lg resize-y" name="topic" id="topic"></textarea>
                            </label>
                            <script>
                                CKEDITOR.replace('topic', {
                                    scayt_autoStartup: false,
                                    enterMode: CKEDITOR.ENTER_BR,
                                    forcePasteAsPlainText: true,
                                    forceSimpleAmpersand: true,
                                    entities: false,
                                    basicEntities: false,
                                    entities_greek: false,
                                    entities_latin: false,
                                    toolbarCanCollapse: false,
                                });
                            </script>
                        </div>
                        <div class="grid grid-cols-1 mb-6 sm:grid-cols-2 md:grid-cols-3 gap-y-4">
                            <div>
                                <h2 class="text-lg font-medium text-gray-800">Sections</h2>
                                <div class="flex flex-col">
                                    @forelse($sections as $section)
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            <input
                                                class="mr-2 border-gray-300 rounded form-checkbox text-primary-500 focus:ring-primary-500"
                                                name="section[{{ $section->id }}]" value="1" type="checkbox">
                                            {{ $section->name }}
                                        </label>
                                    @empty
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            No section's in this language
                                        </label>
                                    @endforelse
                                </div>
                            </div>
                            {{-- <div>
                                <h2 class="text-lg font-medium text-gray-800">Section tags</h2>
                                <div class="flex flex-col">
                                    @forelse($sectionTags as $sectionTag)
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            <input
                                                class="mr-2 border-gray-300 rounded form-checkbox text-primary-500 focus:ring-primary-500"
                                                name="sectionTag[{{ $sectionTag->id }}]" value="1" type="checkbox">
                                            {{ $sectionTag->name }}
                                        </label>
                                    @empty
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            No section tag's in this language
                                        </label>
                                    @endforelse
                                </div>
                            </div> --}}
                            <div>
                                <h2 class="text-lg font-medium text-gray-800">Loan types</h2>
                                <div class="flex flex-col">
                                    @forelse($loanTypes as $loanType)
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            <input
                                                class="mr-2 border-gray-300 rounded form-checkbox text-primary-500 focus:ring-primary-500"
                                                name="loanType[{{ $loanType->id }}]" value="1" type="checkbox">
                                            {{ $loanType->name }}
                                        </label>
                                    @empty
                                        <label class="flex items-center mx-2 my-1 text-gray-800 text-normal">
                                            No loan type's in this language
                                        </label>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <h2 class="text-lg font-medium text-gray-800">Active</h2>
                        <div class="flex mt-2 mb-6">
                            <label class="flex items-center text-gray-800 text-normal">
                                <input type="hidden" name="active" value="0">
                                <input
                                    class="mr-2 border-gray-300 rounded form-checkbox text-primary-500 focus:ring-primary-500"
                                    name="active" type="checkbox" value="1">
                                Active
                            </label>
                        </div>
                        <div class="flex flex-row justify-end">
                            <button
                                class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 bg-gray-700 rounded hover:bg-gray-800"
                                type="submit">
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        const activeFaq = document.getElementById("sidebar-faq");
        activeFaq.classList.add("text-gray-600", "bg-gray-100");

        function displayImage(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let FaqImage = document.getElementById("Faq-image");
                    let FaqImageContainer = document.getElementById("Faq-image-container");
                    FaqImage.src = e.target.result;
                    FaqImage.alt = "Logo";
                    FaqImageContainer.classList.add("h-48");
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        const textareaElements = document.querySelectorAll("#auto_expand");
        textareaElements.forEach((element) => {
            element.style.cssText = "height: 42px; position: absolute; top: 0px; left: 0px; right: 0px;";
            element.parentNode.style.cssText = "height: 42px;";
            element.addEventListener("focus", (e) => {
                if (e.target.scrollHeight < 42) {
                    e.target.style.height = "42px";
                } else {
                    e.target.style.height = `${e.target.scrollHeight}px`;
                }
            })
            element.addEventListener("blur", (e) => {
                e.target.style.height = "42px";
            })
        })
    </script>
@endsection
