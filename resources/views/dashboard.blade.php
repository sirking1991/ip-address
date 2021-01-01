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
                    <ul class="list-group ip-addresses">
                        <li class="list-group-item active font-bold">
                            IP Addresses
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-secondary float-right text-light" onclick="openModalForm()">
                                <i class="bi bi-plus"></i>&nbsp;Add New
                            </button>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="frm">
                        <div class="form-group row">
                            <label for="ip" class="col-sm-4 col-form-label">IP Address <small class='text-muted font-italic'>(must be a valid IP address)</small></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ip">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="label" class="col-sm-4 col-form-label">Label</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="label">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">            
                    <button type="button" class="btn btn-sm btn-secondary" onclick="viewAuditLogs()">View Logs</button>
                    <button type="button" class="btn btn-sm btn-success" onclick="save()">Save</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  

    <!-- Audit Log Modal -->
    <div class="modal fade" id="modalAuditLogs" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <ul class="list-group"></ul>
                </div>
                <div class="modal-footer">            
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" data-target="#modalAuditLog">Close</button>
                </div>
            </div>
        </div>
    </div>      

    <script>
        list = [];

        $(function(){
            getList();
        })

        function getList() {
            axios.get('ipaddress-list')
                .then((resp)=>{
                    list = resp.data;
                    refreshList();
                });
        }

        function refreshList(){
            $('li.list-group-item.data').remove();
            for (let i = 0; i < list.length; i++) {
                const e = list[i];
                let li = '<li class="list-group-item data cursor-pointer hover:bg-blue-100" onclick="openModalForm(' + i + ')">' + 
                            e.ip + 
                            '<span class="badge badge-pill badge-secondary ml-2">' + e.label + '</span>' + 
                            '<span class="float-right text-muted"><small>Last updated on ' + e.updated_at + '</small></span>'
                        '</li>'
                $('ul.ip-addresses').append(li);                
            }
        }

        function openModalForm(index) {
            console.log(index);
            if (undefined!=list[index]) {
                $('#frm input[name=ip]').val(list[index].ip);
                $('#frm input[name=label]').val(list[index].label);
            } else {
                $('#frm input[name=ip]').val('');
                $('#frm input[name=label]').val('');
            }
            
            $('#modalForm').modal('show');            
        }

        function save() {
            // validation
            if (''==$('#frm input[name=ip]').val()) {
                alert('IP address should be filled up');
                return;
            }

            axios.post('ipaddress-save', {
                ip : $('#frm input[name=ip]').val(),
                label : $('#frm input[name=label]').val()
            })
            .then(resp=>{
                $('#modalForm').modal('hide'); 
                list = resp.data;
                refreshList();
            })
            .catch(function (error) {
                alert(error.response.data);
            });
        }

        function viewAuditLogs() {
            axios.get('ipaddress-audit-logs/' + $('#frm input[name=ip]').val())
                .then((resp)=>{
                    let logs = resp.data;
                    console.log(resp.data);
                    $('#modalAuditLogs li').remove();
                    for (let i = 0; i < logs.length; i++) {
                        const e = logs[i];
                        let li = '<li class="list-group-item">' + 
                                    e.remarks + ' by ' + e.user.name + ' on ' + e.created_at
                                '</li>'
                        $('#modalAuditLogs ul').append(li);                
                    }
                    $('#modalAuditLogs').modal('show');
                })
                .catch(function (error) {
                    alert(error.response.data);
                });
        }
    </script>

</x-app-layout>
