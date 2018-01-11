<template>
    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button class="btn btn-info" data-toggle="modal" data-target="#createModel">Add New</button>
            </div>
            <p>Hello world, This is just sample admin menu to show model data with Vue JS and WP Ajax.</p>
            <table class="widefat wp_pluginner-table-scrollable" style="margin-top:25px">
                <thead>
                    <tr>
                        <th class="row-title">id</th>
                        <th class="row-title">key</th>
                        <th class="row-title">value</th>
                        <th class="row-title">delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(example,key) in examples" v-bind:class="{'alternate': isAlternateClass(key)}">
                        <td>{{ example.id }}</td>
                        <td>{{ example.key }}</td>
                        <td>{{ example.value }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" @click="deleteModel(example.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div id="createModel" class="modal fade" data-backdrop="static" role="dialog" style="overflow-y:visible;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="form-horizontal form-bordered" @submit="createModel">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Example Model</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-control-label" for="defaultData-key">Key</label>
                                    <input type="text" id="defaultData-key" class="form-control" required v-model="model.key">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="defaultData-value">Value</label>
                                    <input type="text" id="defaultData-value" class="form-control" required v-model="model.value">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" :disabled="process">
                                    <span v-if="process"><i class="fa fa-refresh fa-spin"></i> Creating...</span>
                                    <span v-else>Create</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default{
    data(){
        return {
            process: false,
            model: {},
            examples: []
        }
    },
    mounted(){
        this.getModel();
    },
    methods: {
        isAlternateClass(key)
        {
            return (key % 2) == 0;
        },
        getModel()
        {
            this.process = true;
            var form_data = this.$root.buildFormData({'function':'getModel'});
            axios.post(this.$root.ajax_url,form_data).then(
                response => {
                    this.process = false;
                    if (response.data.success) {
                        this.examples = response.data.data.examples;
                    } else {
                        var message = "Unknown Response."
                        if (
                            typeof response !== 'undefined' &&
                            typeof response.data !== 'undefined' &&
                            typeof response.data.data !== 'undefined' &&
                            typeof response.data.data.message !== 'undefined'
                        ){
                            message = response.data.data.message;
                        }
                        toastr.error(message);
                    }
                },
                error => {
                    this.process = false;
                    toastr.error("Unknown Response.");
                }
            );
        },
        createModel(e)
        {
            e.preventDefault();
            this.process = true;
            var form_data = this.$root.buildFormData({
                'function': 'createModel',
                'model': JSON.stringify(this.model)
            });
            axios.post(this.$root.ajax_url,form_data).then(
                response => {
                    this.process = false;
                    if (response.data.success) {
                        toastr.success("New model created");
                        this.getModel();
                    } else {
                        var message = "Unknown Response.";
                        if (
                            typeof response !== 'undefined' &&
                            typeof response.data !== 'undefined' &&
                            typeof response.data.data !== 'undefined' &&
                            typeof response.data.data.message !== 'undefined'
                        ){
                            message = response.data.data.message;
                        }
                        toastr.error(message);
                    }
                },
                error => {
                    this.process = false;
                    toastr.error("Unknown Response.");
                }
            );
        },
        deleteModel(id)
        {
            this.process = true;
            var form_data = this.$root.buildFormData({
                'function': 'deleteModel',
                'id': id
            });
            axios.post(this.$root.ajax_url,form_data).then(
                response => {
                    this.process = false;
                    if (response.data.success) {
                        toastr.success("Selected model deleted");
                        this.getModel();
                    } else {
                        var message = "Unknown Response."
                        if (
                            typeof response !== 'undefined' &&
                            typeof response.data !== 'undefined' &&
                            typeof response.data.data !== 'undefined' &&
                            typeof response.data.data.message !== 'undefined'
                        ){
                            message = response.data.data.message;
                        }
                        toastr.error(message);
                    }
                },
                error => {
                    this.process = false;
                    toastr.error("Unknown Response.");
                }
            );
        }
    }
}
</script>
