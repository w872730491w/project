<template lang="html">
    <div :class="type=='ask' ? 'AskDetail' : '' ">
        <div v-if="type=='ask'" class="AskDetail-actionsWrapper">
            <div class="AskDetail-actions">
                <el-tooltip placement="top" content="展开工具栏">
                    <button @click="isShowToolBar =!isShowToolBar" aria-label="展开工具栏" type="button" :class="[toolBarBtnClass, {'is-active': isShowToolBar}]">
                        <svg class="Zi Zi--Format" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M6.295 15.4L5.06 19H3L7.684 6h1.813l4.684 13h-2.06l-1.235-3.6h-4.59zM17.092 19c-1.548 0-2.647-.962-2.647-2.391 0-1.428 1.063-2.27 2.916-2.384l1.782-.103v-.43c0-.653-.419-.996-1.286-.996-.724 0-1.194.25-1.323.663l-.046.147H14.7l.027-.234c.161-1.366 1.436-2.24 3.196-2.24 1.93 0 3.076.987 3.076 2.66v5.188h-1.81v-.75c-.5.56-1.243.87-2.098.87zM6.89 13.646h3.4L8.59 8.69l-1.7 4.956zM17.582 15.7c-.901.06-1.267.325-1.267.842 0 .504.439.827 1.146.827.973 0 1.682-.6 1.682-1.383v-.385l-1.56.1z"></path></svg>
                    </button>
                </el-tooltip>
                <el-tooltip placement="top" content="插入图片">
                    <button @click="$refs.imgInput.click()" aria-label="插入图片" type="button" :class="[toolBarBtnClass]">
                        <svg class="Zi Zi--InsertImage" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M21 17.444C21 18.3 20.1 19 19 19H5c-1.1 0-2-.7-2-1.556V6.556C3 5.7 3.9 5 5 5h14c1.1 0 2 .7 2 1.556v10.888zm-9.437-3.919a.5.5 0 0 1-.862.013l-1.26-2.065a.5.5 0 0 0-.861.012l-2.153 3.767a.5.5 0 0 0 .435.748h10.292a.5.5 0 0 0 .438-.741L14.573 9.78a.5.5 0 0 0-.872-.006l-2.138 3.75z" fill-rule="evenodd"></path></svg>
                    </button>
                </el-tooltip>
                <el-tooltip placement="top" content="上传视频">
                    <button @click="showVideoModal" aria-label="上传视频" type="button" :class="[toolBarBtnClass]">
                        <svg class="Zi Zi--InsertVideo" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M10.546 15c-.466.273-.86.053-.86-.5V9.505c0-.565.385-.778.86-.501l4.278 2.497c.466.272.475.726 0 1.003L10.546 15zM5 5S3 5 3 7v10s0 2 2.002 2H19c2 0 2-2 2-2V7c0-2-2-2-2-2H5z" fill-rule="evenodd"></path></svg>
                    </button>
                </el-tooltip>
            </div>
        </div>
        <div class="AskDetail-inputWrapper">
            <div :class="[type=='ask' ? 'AskDetail-input' : 'AnswerForm-editor AnswerForm-container', 'Input-wrapper Input-wrapper--spread Input-wrapper--large Input-wrapper--noPadding']">
                <div class="Input Editable">
                    <div v-show="isShowToolBar" class="Editable-toolbar">
                        <el-tooltip placement="top" content="粗体 (Ctrl+B)">
                            <button @click="toggle('bold')" aria-label="粗体" type="button" :class="[toolBarBtnClass, {'is-active': state.bold}]">
                                <svg class="Zi Zi--FormatBold" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M9 17.025V13h4.418c1.19 0 2.415.562 2.415 2.012s-1.608 2.013-2.9 2.013H9zM9 7h4.336c1 0 1.814.888 1.814 2 0 .89-.814 2-1.814 2H9V7zm8.192 1.899a3.893 3.893 0 0 0-3.888-3.889S9.334 5 8.167 5C7 5 7 6.167 7 6.167v11.666C7 19 8.167 19 8.167 19l5.572.01c2.333 0 4.231-1.86 4.231-4.148a4.122 4.122 0 0 0-1.77-3.372 3.873 3.873 0 0 0 .992-2.591z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="斜体 (Ctrl+I)">
                            <button @click="toggle('italic')" aria-label="斜体" type="button" :class="[toolBarBtnClass, {'is-active': state.italic}]">
                                <svg class="Zi Zi--FormatItalic" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M15.751 5h-5.502a.751.751 0 0 0-.749.75c0 .417.336.75.749.75H12l-2 11H8.249a.751.751 0 0 0-.749.75c0 .417.336.75.749.75h5.502a.751.751 0 0 0 .749-.75.748.748 0 0 0-.749-.75H12l2-11h1.751a.751.751 0 0 0 .749-.75.748.748 0 0 0-.749-.75" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <span class="Editable-toolbar-separator"></span>
                        <el-tooltip placement="top" content="标题 (Ctrl+Alt+1)">
                            <button @click="insert('title', '<H2>')" aria-label="标题" type="button" :class="[toolBarBtnClass, {'is-active': state.onlyGroup.title}]">
                                <svg class="Zi Zi--FormatHeader" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M7 6.007C7 5.45 7.444 5 8 5c.552 0 1 .45 1 1.007v11.986C9 18.55 8.556 19 8 19c-.552 0-1-.45-1-1.007V6.007zm8 0C15 5.45 15.444 5 16 5c.552 0 1 .45 1 1.007v11.986C17 18.55 16.556 19 16 19c-.552 0-1-.45-1-1.007V6.007zM9 11h6v2H9v-2z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="引用块 (Ctrl+Shift+U)">
                            <button @click="insert('quote', '<blockquote>')" aria-label="引用块" type="button" :class="[toolBarBtnClass, {'is-active': state.onlyGroup.quote}]">
                                <svg class="Zi Zi--FormatBlockquote" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M17.975 12.209c.504.454.822 1.05.952 1.792.061.35.055.715-.022 1.096-.075.379-.209.718-.4 1.018-.465.73-1.155 1.175-2.07 1.337-.874.153-1.684-.06-2.432-.638a3.6 3.6 0 0 1-.916-1.043 3.92 3.92 0 0 1-.506-1.336c-.172-.98-.03-2.026.425-3.142.455-1.116 1.155-2.118 2.1-3.007.8-.757 1.456-1.182 1.97-1.273a.72.72 0 0 1 .544.104.656.656 0 0 1 .286.452c.054.31-.095.601-.45.877-.856.67-1.455 1.27-1.796 1.798-.323.513-.467.873-.43 1.079.034.196.21.287.524.274l.191-.001.249-.029a2.436 2.436 0 0 1 1.781.642zm-7.51 0c.504.454.821 1.05.951 1.792.062.35.056.715-.02 1.096-.077.379-.21.718-.401 1.018-.465.73-1.155 1.175-2.07 1.337-.874.153-1.684-.06-2.432-.638a3.6 3.6 0 0 1-.916-1.043 3.92 3.92 0 0 1-.506-1.336c-.172-.98-.03-2.026.424-3.142.455-1.116 1.156-2.118 2.101-3.007.8-.757 1.456-1.182 1.97-1.273a.72.72 0 0 1 .544.104.656.656 0 0 1 .285.452c.055.31-.094.601-.45.877-.855.67-1.454 1.27-1.796 1.798-.322.513-.466.873-.43 1.079.034.196.21.287.525.274l.191-.001.248-.029a2.436 2.436 0 0 1 1.782.642z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="代码块 (Ctrl+Alt+C)">
                            <button @click="insert('block', '<pre>')" aria-label="代码块" type="button" :class="[toolBarBtnClass, {'is-active': state.onlyGroup.block}]">
                                <svg class="Zi Zi--FormatCode" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M19.718 11.559a.961.961 0 0 1 .007 1.352l-2.201 2.033-1.319 1.219a.937.937 0 0 1-1.33-.005.961.961 0 0 1-.001-1.345l2.813-2.576-2.804-2.568a.96.96 0 0 1-.008-1.352.963.963 0 0 1 1.337 0l2.475 2.289 1.031.953zm-7.462-5.567a1.001 1.001 0 0 1 1.16-.818c.544.096.907.616.81 1.165l-2.082 11.804a1.001 1.001 0 0 1-1.16.818 1.003 1.003 0 0 1-.81-1.165l2.082-11.804zM9.123 8.316a.96.96 0 0 1 0 1.345l-2.812 2.575 2.806 2.569a.962.962 0 0 1 .006 1.35.935.935 0 0 1-1.337 0l-2.093-1.934-1.412-1.305a.961.961 0 0 1-.007-1.352l2.833-2.62.685-.634c.345-.35.976-.354 1.331.006z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <span class="Editable-toolbar-separator"></span>
                        <el-tooltip placement="top" content="插入链接 (Ctrl+K)">
                            <button @click="showLinkModal" aria-label="插入链接" type="button" :class="[toolBarBtnClass]">
                                <svg class="Zi Zi--InsertLink" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M6.77 17.23c-.905-.904-.94-2.333-.08-3.193l3.059-3.06-1.192-1.19-3.059 3.058c-1.489 1.489-1.427 3.954.138 5.519s4.03 1.627 5.519.138l3.059-3.059-1.192-1.192-3.059 3.06c-.86.86-2.289.824-3.193-.08zm3.016-8.673l1.192 1.192 3.059-3.06c.86-.86 2.289-.824 3.193.08.905.905.94 2.334.08 3.194l-3.059 3.06 1.192 1.19 3.059-3.058c1.489-1.489 1.427-3.954-.138-5.519s-4.03-1.627-5.519-.138L9.786 8.557zm-1.023 6.68c.33.33.863.343 1.177.029l5.34-5.34c.314-.314.3-.846-.03-1.176-.33-.33-.862-.344-1.176-.03l-5.34 5.34c-.314.314-.3.846.03 1.177z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="上传图片">
                            <button @click="$refs.imgInput.click()" aria-label="上传图片" type="button" :class="[toolBarBtnClass]">
                                <svg class="Zi Zi--InsertImage" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M21 17.444C21 18.3 20.1 19 19 19H5c-1.1 0-2-.7-2-1.556V6.556C3 5.7 3.9 5 5 5h14c1.1 0 2 .7 2 1.556v10.888zm-9.437-3.919a.5.5 0 0 1-.862.013l-1.26-2.065a.5.5 0 0 0-.861.012l-2.153 3.767a.5.5 0 0 0 .435.748h10.292a.5.5 0 0 0 .438-.741L14.573 9.78a.5.5 0 0 0-.872-.006l-2.138 3.75z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="上传视频">
                            <button @click="showVideoModal" aria-label="上传视频" data-tooltip="上传视频" type="button" :class="[toolBarBtnClass]">
                                <svg class="Zi Zi--InsertVideo" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M10.546 15c-.466.273-.86.053-.86-.5V9.505c0-.565.385-.778.86-.501l4.278 2.497c.466.272.475.726 0 1.003L10.546 15zM5 5S3 5 3 7v10s0 2 2.002 2H19c2 0 2-2 2-2V7c0-2-2-2-2-2H5z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <el-tooltip placement="top" content="插入分割线 (Ctrl+Shift+S)">
                            <button @click="insertHr" aria-label="插入分割线" type="button" :class="[toolBarBtnClass]">
                                <svg class="Zi Zi--InsertDivider" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M4 7c0-.552.445-1 1-1h14c.552 0 1 .444 1 1 0 .552-.445 1-1 1H5c-.552 0-1-.444-1-1zm0 5a1 1 0 0 1 1.01-1h1.98a1 1 0 1 1 0 2H5.01C4.451 13 4 12.556 4 12zm6 0a1 1 0 0 1 1.01-1h1.98a1 1 0 1 1 0 2h-1.98c-.558 0-1.01-.444-1.01-1zm6 0a1 1 0 0 1 1.01-1h1.98a1 1 0 1 1 0 2h-1.98c-.558 0-1.01-.444-1.01-1zM4 17c0-.552.445-1 1-1h14c.552 0 1 .444 1 1 0 .552-.445 1-1 1H5c-.552 0-1-.444-1-1z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                        <span class="Editable-toolbar-separator"></span>
                        <el-tooltip placement="top" content="清除格式 (Ctrl+\)">
                            <button @click="clearFormat" aria-label="清除格式" type="button" :class="[toolBarBtnClass]">
                                <svg class="Zi Zi--FormatClear" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M9.864 12.83l1.641 1.642-1.171 2.874a1.693 1.693 0 0 1-1.585 1.055.782.782 0 0 1-.716-1.077l1.83-4.494zM11.5 8.811L12.24 7H9.69l-2-2h10.672a1 1 0 1 1 0 2h-3.813l-1.406 3.452L11.5 8.811zM5.293 6.845a1 1 0 0 1 1.414 0l10.046 10.046a1 1 0 0 1-1.414 1.414L5.293 8.26a1 1 0 0 1 0-1.415z" fill-rule="evenodd"></path></svg>
                            </button>
                        </el-tooltip>
                    </div>
                    <div class="Dropzone RichText ztext" style="min-height: 78px;">
                        <div class="DraftEditor-root">
                            <div class="public-DraftEditorPlaceholder-root">
                                <div v-show="!content" class="public-DraftEditorPlaceholder-inner" style="white-space: pre-wrap;">{{ placeholder }}</div>
                            </div>
                            <div class="DraftEditor-editorContainer">
                                <div @keydown="keydown"
                                     @keyup="keyup"
                                     @focus="focus"
                                     @blur="blur"
                                     @input="input"
                                     @keydown.enter="resetGroup"
                                     @keydown.delete="checkGroup"
                                     @keyup.ctrl.alt.1.prevent="insert('title', '<H2>')"
                                     @keyup.ctrl.shift.u.prevent="insert('quote', '<blockquote>')"
                                     @keyup.ctrl.alt.c.prevent="insert('block', '<pre>')"
                                     @keyup.ctrl.k.prevent="showLinkModal"
                                     ref="editor"
                                     class="notranslate public-DraftEditor-content"
                                     contenteditable="true"
                                     spellcheck="true"
                                     style="outline: none; user-select: text; white-space: pre-wrap; word-wrap: break-word; min-height: 122px;"
                                ></div>
                                <input type="hidden" name="body" v-model="content">
                                <input @change.navite="imgInputChange" ref="imgInput" multiple="" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <modal ref="insertLink">
            <div slot="header" class="Modal-header">
                <h3>插入链接</h3>
            </div>
            <form @submit.prevent="insertLink" class="LinkModal-form">
                <div class="LinkModal-input Input-wrapper Input-wrapper--spread Input-wrapper--large">
                    <svg class="Zi Zi--InsertText" fill="#9fadc7" viewBox="0 0 24 24" width="24" height="24"><path d="M13 7h5a1 1 0 0 0 0-2H6a1 1 0 1 0 0 2h5v11a1 1 0 0 0 2 0V7z" fill-rule="evenodd"></path></svg>
                    <input v-model="link.name" type="text" class="Input" placeholder="输入链接文本">
                </div>
                <div class="LinkModal-input Input-wrapper Input-wrapper--spread Input-wrapper--large">
                    <svg class="Zi Zi--InsertLink" fill="#9fadc7" viewBox="0 0 24 24" width="24" height="24"><path d="M6.77 17.23c-.905-.904-.94-2.333-.08-3.193l3.059-3.06-1.192-1.19-3.059 3.058c-1.489 1.489-1.427 3.954.138 5.519s4.03 1.627 5.519.138l3.059-3.059-1.192-1.192-3.059 3.06c-.86.86-2.289.824-3.193-.08zm3.016-8.673l1.192 1.192 3.059-3.06c.86-.86 2.289-.824 3.193.08.905.905.94 2.334.08 3.194l-3.059 3.06 1.192 1.19 3.059-3.058c1.489-1.489 1.427-3.954-.138-5.519s-4.03-1.627-5.519-.138L9.786 8.557zm-1.023 6.68c.33.33.863.343 1.177.029l5.34-5.34c.314-.314.3-.846-.03-1.176-.33-.33-.862-.344-1.176-.03l-5.34 5.34c-.314.314-.3.846.03 1.177z" fill-rule="evenodd"></path></svg>
                    <input v-model="link.address" type="text" class="Input" placeholder="输入链接地址">
                </div>
                <div class="ModalButtonGroup ModalButtonGroup--horizontal">
                    <button @click="closeLinkModal" type="button" class="Button Button--grey">取消</button>
                    <button :disabled="!link.address" type="submit" class="Button Button--primary Button--blue">确认</button>
                </div>
            </form>
        </modal>
        <modal ref="insertVideo">
            <div slot="header" class="Modal-header">
                <p class="Editable-videoModal-title">本地上传</p>
            </div>
            <form @click="$refs.videoInput.click()" data-za-detail-view-path-module="VideoUploadCard">
                <div class="Editable-videoModal-container">
                    <div class="Editable-videoModal-uploader">
                        <div class="Editable-videoModal-uploader-icon">
                            <svg class="Zi Zi--BackToTop" fill="currentColor" viewBox="0 0 24 24" width="70" height="70"><path d="M16.036 19.59a1 1 0 0 1-.997.995H9.032a.996.996 0 0 1-.997-.996v-7.005H5.03c-1.1 0-1.36-.633-.578-1.416L11.33 4.29a1.003 1.003 0 0 1 1.412 0l6.878 6.88c.782.78.523 1.415-.58 1.415h-3.004v7.005z"></path></svg>
                        </div>
                        <div class="Editable-videoModal-uploader-text">选择要上传的文件</div>
                        <div class="Editable-videoModal-uploader-tip">请上传超过10M的文件</div>
                        <input @change.navite="videoInputChange($event)" ref="videoInput" accept=".3gp,.asf,.avi,.dat,.f4v,.flv,.m4v,.mkv,.mov,.mp4,.mp4v,.mpe,.mpeg,.mpg,.ra,.ram,.rm,.rmvb,.vob,.webm,.wm,.wmv" type="file" required="">
                    </div>
                </div>
            </form>
        </modal>
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            default: 'ask'
        },
        showToolBar: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            content: "",
            is_focus: false,
            placeholder: "输入问题背景、条件等详细信息（选填）",
            toolBarBtnClass: [
                'Button',
                'Editable-control',
                'Button--plain'
            ],
            isShowToolBar: false,
            state: {
                bold: false,
                italic: false,
                onlyGroup: {
                    title: false,
                    block: false,
                    quote: false,
                    ol: false,
                    ul: false
                }
            },
            link: {
                name: "",
                address: ""
            }
        }
    },
    methods: {
        // 上传图片
        imgInputChange () {
            const formData = new FormData();
            for (var file in this.$refs.imgInput.files) {
                formData.append('img[]', this.$refs.imgInput.files[file]);
            }
            axios.post('/upload/' + ( this.type=='ask' ? 'question' : 'answer' ), formData).then((res) => {
                res.data.forEach((val) => {
                    $(this.$refs.editor).append(`<br><img data-size="normal" class="Image FocusPlugin--unfocused Image--isBlock" src="${val}"><br>`);
                });
                $('.Image').click(function () {
                    $(this).removeClass('FocusPlugin--unfocused').addClass('FocusPlugin--focused');
                    $(document).on('click', function(e){
                        if(!$(e.target).hasClass('FocusPlugin--focused')) {
                            $('.Image.FocusPlugin--focused').removeClass('FocusPlugin--focused').addClass('FocusPlugin--unfocused');
                            $(document).unbind(e);
                        }
                    });
                });
                $('.Image').click(function () {
                    const size = $(this).attr('data-size');
                    $(this).attr('data-size', size == 'small' ? 'normal' : 'small');
                });
                this.$refs.editor.focus();
                this.input();
            });
        },
        // 上传视频
        videoInputChange (e) {
            const input = e.target;
            const file = input.files[0];
            const size = file.size / 1024 / 1024;
            if(size > 10) {
                alert('文件大小超过10M');
                $(input).val('');
                return false;
            }
            this.closeVideoModal();
            $(this.$refs.editor).append(`<br><div class="Editable-videoUploader FocusPlugin--unfocused"><div class="VideoCard VideoCard--interactive"><div class="VideoCard-layout"><div class="VideoCard-video"><div class="VideoCard-video-content"><div class="VideoCard-thumbnail"><div class="Editable-videoUploader-thumbnail"><div class="Editable-videoUploader-text"><div class="Editable-videoUploader-status">视频上传中</div><div class="Editable-videoUploader-size"></div></div></div><div class="Editable-videoUploader-progress"><div id="videoProgress" class="Editable-videoUploader-progress-bar"></div></div></div></div></div></div></div>`);
            const formData = new FormData();
            formData.append('video', file);
            const xhrOnProgress = function(fun) {
                xhrOnProgress.onprogress = fun; //绑定监听
                //使用闭包实现监听绑
                return function() {
                    //通过$.ajaxSettings.xhr();获得XMLHttpRequest对象
                    var xhr = $.ajaxSettings.xhr();
                    //判断监听函数是否为函数
                    if (typeof xhrOnProgress.onprogress !== 'function')
                        return xhr;
                    //如果有监听函数并且xhr对象支持绑定时就把监听函数绑定上去
                    if (xhrOnProgress.onprogress && xhr.upload) {
                        xhr.upload.onprogress = xhrOnProgress.onprogress;
                    }
                    return xhr;
                }
            }
            $.ajax({
                url: '/uploadVideo/question',
                type: 'POST',
                cache: false,
                data: formData,
                processData: false, // 必写
                contentType: false, // 必写
                xhr: xhrOnProgress(function(e){
                    const percent = Math.round(e.loaded*100 / e.total) + '%';
                    $('#videoProgress').css('width', percent);
                })
            }).done(function (data) {
                $('#videoProgress').after('<div class="LoadingBar is-active"></div>');
                $.ajax({
                    url: '/getVideoCover/question',
                    type: 'POST',
                    data: {
                        path: data
                    },
                    success: function (data) {
                        $('#videoProgress').parent().prev().html(`<img src="${data}" alt="视频封面"><div class="VideoCard-play-button"><svg viewBox="0 0 64 64" width="64" height="64" class="VideoCard-playIcon"><path fill-opacity="0.9" fill="#fff" d="M32,64 C14.326888,64 0,49.673112 0,32 C0,14.326888 14.326888,0 32,0 C49.673112,0 64,14.326888 64,32 C64,49.673112 49.673112,64 32,64 Z M32.2363929,61.6 C48.5840215,61.6 61.8363929,48.3476286 61.8363929,32 C61.8363929,15.6523714 48.5840215,2.4 32.2363929,2.4 C15.8887643,2.4 2.63639293,15.6523714 2.63639293,32 C2.63639293,48.3476286 15.8887643,61.6 32.2363929,61.6 Z"></path><circle fill-opacity="0.3" fill="#000" cx="32" cy="32" r="29.6"></circle><path fill-opacity="0.9" fill="#fff" d="M43.5634409,30.7271505 C44.6882014,31.4301259 44.6868607,32.5707121 43.5634409,33.2728495 L28.4365591,42.7271505 C27.3117986,43.4301259 26.4,42.9221451 26.4,41.5999847 L26.4,22.4000153 C26.4,21.0745235 27.3131393,20.5707121 28.4365591,21.2728495 L43.5634409,30.7271505 Z"></path></svg></div>`);
                        $('#videoProgress').remove();
                        this.$refs.editor.focus();
                        this.input();
                    }.bind(this)
                });
            }.bind(this));
        },
        // 切换粗体，斜体等
        toggle (type) {
            this.state[type] = document.execCommand(type);
            this.$refs.editor.focus();
            this.input();
        },
        // 插入链接
        insertLink () {
            const {link} = this;
            $(this.$refs.editor).append(`<a class="Link ztext-link" target="_blank" href="${link.address}">${link.name}</a>`);
            this.$refs.editor.focus();
            this.input();
        },
        insertHr () {
            $(this.$refs.editor).append(`\r<hr>\r`).focus();
            this.input();
        },
        // 插入标题，代码块等
        insert (type, element) {
            for (var state in this.state.onlyGroup) {
                if(state != type) {
                    this.state.onlyGroup[state] = false;
                }
            }
            if(this.state.onlyGroup[type]) {
                document.execCommand('formatBlock', false, '<div>');
                this.state.onlyGroup[type] = false;
            } else {
                this.state.onlyGroup[type] = document.execCommand('formatBlock', false, element);
            }
            this.$refs.editor.focus();
            this.input();
        },
        clearFormat () {
            document.execCommand('RemoveFormat');
        },
        // 让title取消
        resetGroup () {
            this.state.onlyGroup.title = false;
        },
        // 判断是否删除节点
        checkGroup () {
            let userSelection = null;
            if (window.getSelection) {
                // Firefox support
                userSelection = window.getSelection();
            } else if (document.selection) {
                // IE Support
                userSelection = document.selection.createRange();
            }
            if($(userSelection.anchorNode).hasClass('notranslate') || this.content == "") {
                for (var state in this.state.onlyGroup) {
                    this.state.onlyGroup[state] = false;
                }
            }
        },
        // 因为不能v-model 所以在输入内容后保存内容
        input () {
            this.content = this.$refs.editor.innerHTML;
        },
        // 获取焦点的时候
        focus () {
            this.is_focus = true;
        },
        // 失去焦点
        blur () {
            this.is_focus = false;
        },
        keydown () {

        },
        // 按键抬起后刷新状态
        keyup () {
            const newState = {
                bold: document.queryCommandState('bold'),
                italic: document.queryCommandState('italic'),
                onlyGroup: this.state.onlyGroup,
            };
            this.state = newState;
        },
        showLinkModal () {
            this.$refs.insertLink.$emit('showModal');
        },
        showVideoModal () {
            this.$refs.insertVideo.$emit('showModal');
        },
        closeLinkModal() {
            this.$refs.insertLink.$emit('closeModal');
        },
        closeVideoModal() {
            this.$refs.insertVideo.$emit('closeModal');
        }
    },
    mounted () {
        this.isShowToolBar = this.showToolBar;
    }
}
</script>

<style lang="css">
</style>
