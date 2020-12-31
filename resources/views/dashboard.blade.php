<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('IP Address') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <ul class="list-group">
                        <li class="list-group-item active font-bold">
                            IP Addresses
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-success float-right text-light" data-toggle="modal" data-target="#modal">
                                <i class="bi bi-plus"></i>&nbsp;Add New
                            </button>
                        </li>
                        <li class="list-group-item cursor-pointer hover:bg-blue-100">Dapibus ac facilisis in</li>
                        <li class="list-group-item cursor-pointer hover:bg-blue-100">Morbi leo risus</li>
                        <li class="list-group-item cursor-pointer hover:bg-blue-100">Porta ac consectetur ac</li>
                        <li class="list-group-item cursor-pointer hover:bg-blue-100">Vestibulum at eros</li>
                      </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <form id="frm">
                    <div class="form-group row">
                        <label for="ip" class="col-sm-4 col-form-label">IP Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ip">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="label" class="col-sm-4 col-form-label">Label</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="label">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-sm btn-primary">Save</button>
            </div>
        </div>
        </div>
    </div>  

</x-app-layout>
