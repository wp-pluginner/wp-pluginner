<template>
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" novalidate v-if="isInitial" return="false">
                <div class="dropbox">
                    <input type="file" @change="onFileChange" class="input-file">
                    <p>
                        Drag your CSV, XML, or JSON file here to begin<br> or click to browse
                    </p>
                </div>
            </form>
            <div class="" v-if="isUploading">
                <h4>Please wait.... <small>uploading <em>{{file.name}}</em></small></h4>
                <div class="progress-bar progress-bar-striped progress-bar-animated" :style="{width: percentUpload}">{{percentUpload}}</div>
            </div>
        </div>
    </div>
</div>
</template>
<style scoped>
img{
    max-height: 36px;
}
</style>
<script>
const STATUS_INITIAL = 0, STATUS_UPLOADING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default{
    data(){
        return {
            file: '',
            ajax_url: window.thewppluginner.ajax_url,
            nonce: window.thewppluginner.nonce,
            currentStatus: 0,
            uploadInPercent: 0
        }
    },
    mounted(){
        this.currentStatus = STATUS_INITIAL;
    },
    computed: {
        isInitial() {
            return this.currentStatus === STATUS_INITIAL;
        },
        isUploading() {
            return this.currentStatus === STATUS_UPLOADING;
        },
        isSuccess() {
            return this.currentStatus === STATUS_SUCCESS;
        },
        isFailed() {
            return this.currentStatus === STATUS_FAILED;
        },
        percentUpload(){
            return this.uploadInPercent + "%";
        }
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length){
                return;
            }
            var file = files[0];
            console.log(file.type);
            if(file.type == 'text/csv' || file.type == 'text/xml' || file.type == 'application/json' ){
                this.uploadFile(files[0]);
            }
        },
        uploadFile(file) {
            this.file = file;
            this.currentStatus = STATUS_UPLOADING;
            console.log(this.file);
            this.upload(file);

        },
        upload(file){
            let form_data = new FormData;
            form_data.set('file',file);
            form_data.set('action','wppinter_import');
            form_data.set('call','create');
            form_data.set('nonce',this.nonce);
            var _this = this;
            axios.post(this.ajax_url,form_data,{
                onUploadProgress: (progressEvent) => {
                    this.uploadInPercent = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                }
            }).then(response => {

            });
        }
    }
}
</script>
<style>
.dropbox {
    outline: 2px dashed white; /* the dash box */
    outline-offset: -10px;
    background: #FFB74D;
    color: #FFF;
    padding: 10px 10px;
    min-height: 200px; /* minimum height */
    position: relative;
    cursor: pointer;
}

.input-file {
    opacity: 0; /* invisible but it's there! */
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
}

.dropbox:hover {
    background: #fd7e14; /* when mouse over to the drop zone, change color */
}

.dropbox p {
    font-size: 1.2em;
    text-align: center;
    padding: 50px 0;
}
</style>
