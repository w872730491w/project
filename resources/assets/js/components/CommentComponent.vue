<template lang="html">
    <div v-if="show || defaultShow" class="Comments-container">
        <div class="Comments Comments--withEditor Comments-withPagination">
            <div class="Topbar CommentTopbar">
                <div class="Topbar-title">
                    <h2 class="CommentTopbar-title">{{comments_count}} 条评论</h2>
                </div>
                <div class="Topbar-options">
                    <button @click="toggleOrderBy" type="button" class="Button Button--plain Button--withIcon Button--withLabel">
                        <span style="display: inline-flex; align-items: center;">​
                            <svg class="Zi Zi--Switch Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M13.004 7V4.232c0-.405.35-.733.781-.733.183 0 .36.06.501.17l6.437 5.033c.331.26.376.722.1 1.033a.803.803 0 0 1-.601.264H2.75a.75.75 0 0 1-.75-.75V7.75A.75.75 0 0 1 2.75 7h10.254zm-1.997 9.999v2.768c0 .405-.35.733-.782.733a.814.814 0 0 1-.5-.17l-6.437-5.034a.702.702 0 0 1-.1-1.032.803.803 0 0 1 .6-.264H21.25a.75.75 0 0 1 .75.75v1.499a.75.75 0 0 1-.75.75H11.007z" fill-rule="evenodd"></path></svg>
                        </span>
                        <template v-if="orderBy=='votes_count'">
                            切换为时间排序
                        </template>
                        <template v-else>
                            切换为默认排序
                        </template>
                    </button>
                </div>
            </div>
            <div v-if="loading" class="Comments-pattern-loading">
                <div class="BounceLoading" style="width: 60px; height: 18px;">
                    <span class="BounceLoading-child" style="top: 6px; left: 0px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: 0s;"></span><span class="BounceLoading-child" style="top: 6px; left: 18px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.1s;"></span><span class="BounceLoading-child" style="top: 6px; left: 36px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.2s;"></span><span class="BounceLoading-child" style="top: 6px; left: 54px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.3s;"></span>
                </div>
            </div>
            <div v-if="!loading">
                <div class="CommentList">
                    <div class="CommentItem" v-for="comment of comments" :key="comment.id">
                        <div class="CommentItem-meta">
                            <span class="UserLink CommentItem-avatar">
                                <a class="UserLink-link" target="_blank" :href="'/people/' + comment.user.id">
                                    <img class="Avatar UserLink-avatar" width="24" height="24" :src="comment.user.avatar" :srcset="`${comment.user.avatar} 2x`" :alt="comment.user.name">
                                </a>
                            </span>
                            <span class="UserLink">
                                <a class="UserLink-link" target="_blank" :href="'/people/' + comment.user.id">
                                    {{ comment.user.name }}
                                </a>
                            </span>
                            <span v-if="comment.replyUser">
                                <span class="CommentItem-reply">回复</span>
                                <span class="UserLink">
                                    <a class="UserLink-link" target="_blank" :href="'/people/'+comment.replyUser.id">
                                        {{ comment.replyUser.name }}
                                    </a>
                                </span>
                            </span>
                            <span class="CommentItem-time">{{comment.created_at}}</span>
                        </div>
                        <div class="RichText ztext CommentItem-content">{{comment.body}}</div>
                        <div v-if="!comment.showReply" class="CommentItem-footer">
                            <button @click="voteComment(comment)" type="button" :class="['Button', 'CommentItem-likeBtn', 'Button--plain', { 'is-liked': comment.is_vote }]">
                                <svg viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg" class="Icon Icon--like Icon--left" width="13" height="16" aria-hidden="true" style="height: 16px; width: 13px;"><title></title><g><path d="M.718 7.024c-.718 0-.718.63-.718.63l.996 9.693c0 .703.718.65.718.65h1.45c.916 0 .847-.65.847-.65V7.793c-.09-.88-.853-.79-.846-.79l-2.446.02zm11.727-.05S13.2 5.396 13.6 2.89C13.765.03 11.55-.6 10.565.53c-1.014 1.232 0 2.056-4.45 5.83C5.336 6.965 5 8.01 5 8.997v6.998c-.016 1.104.49 2 1.99 2h7.586c2.097 0 2.86-1.416 2.86-1.416s2.178-5.402 2.346-5.91c1.047-3.516-1.95-3.704-1.95-3.704l-5.387.007z"></path></g></svg>
                                <template v-if="comment.votes_count">
                                    {{comment.votes_count}}
                                </template>
                            </button>
                            <!-- <template v-if="comment.is_self">
                                <button type="button" class="Button Button--plain">
                                    <svg viewBox="0 0 18 20" class="Icon Icon--trash Icon--left" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M13.464 2s.05-2-1.48-2H6C4.193 0 4.464 2 4.464 2H1.752c-2.57 0-2.09 3.5 0 3.5l1.213 13.027S2.965 20 4.475 20h8.987c1.502 0 1.502-1.473 1.502-1.473l1.2-13.027c2.34 0 2.563-3.5 0-3.5h-2.7zM5.936 16.5l-.58-9h1.8v9h-1.22zm4.824 0v-9h1.8l-.61 9h-1.19z"></path></g></svg>
                                    删除
                                </button>
                            </template> -->
                            <template>
                                <button @click="reply(comment)" type="button" class="Button CommentItem-hoverBtn Button--plain">
                                    <svg viewBox="0 0 22 16" class="Icon Icon--reply Icon--left" width="13" height="16" aria-hidden="true" style="height: 16px; width: 13px;"><title></title><g><path d="M21.96 13.22c-1.687-3.552-5.13-8.062-11.637-8.65-.54-.053-1.376-.436-1.376-1.56V.677c0-.52-.635-.915-1.116-.52L.47 6.67C.18 6.947 0 7.334 0 7.763c0 .376.14.722.37.987 0 0 6.99 6.818 7.442 7.114.453.295 1.136.124 1.135-.5V13c.027-.814.703-1.466 1.532-1.466 1.185-.14 7.596-.077 10.33 2.396 0 0 .395.257.535.257.892 0 .614-.967.614-.967z"></path></g></svg>
                                    回复
                                </button>
                                <button type="button" class="Button CommentItem-hoverBtn Button--plain">
                                    <svg viewBox="0 0 20 18" xmlns="http://www.w3.org/2000/svg" class="Icon Icon--like Icon--left" width="13" height="16" aria-hidden="true" style="transform: rotate(180deg); height: 16px; width: 13px;"><title></title><g><path d="M.718 7.024c-.718 0-.718.63-.718.63l.996 9.693c0 .703.718.65.718.65h1.45c.916 0 .847-.65.847-.65V7.793c-.09-.88-.853-.79-.846-.79l-2.446.02zm11.727-.05S13.2 5.396 13.6 2.89C13.765.03 11.55-.6 10.565.53c-1.014 1.232 0 2.056-4.45 5.83C5.336 6.965 5 8.01 5 8.997v6.998c-.016 1.104.49 2 1.99 2h7.586c2.097 0 2.86-1.416 2.86-1.416s2.178-5.402 2.346-5.91c1.047-3.516-1.95-3.704-1.95-3.704l-5.387.007z"></path></g></svg>
                                    踩
                                </button>
                                <button type="button" class="Button CommentItem-hoverBtn Button--plain">
                                    <svg viewBox="0 0 18 20" class="Icon Icon--report Icon--left" width="11" height="16" aria-hidden="true" style="height: 16px; width: 11px;"><title></title><g><path d="M16.947 1.13c-.633.135-3.927.638-5.697.384-3.133-.45-4.776-2.54-9.95-.888C.305 1.04.025 1.664.025 2.646L0 18.807c0 .3.1.54.304.718.195.202.438.304.73.304.275 0 .52-.102.73-.304.202-.18.304-.418.304-.718v-6.58c4.533-1.235 8.047.668 8.562.864 2.343.893 5.542.008 6.774-.657.397-.178.596-.474.596-.887V1.964c0-.6-.42-.972-1.053-.835z"></path></g></svg>
                                    举报
                                </button>
                            </template>
                        </div>
                        <div v-if="comment.showReply" class="CommentItem-editor CommentEditor--inCommentItem">
                            <div class="CommentEditor-input Input-wrapper Input-wrapper--spread Input-wrapper--large">
                                <input v-model="comment.text" type="text" class="Input" :placeholder="'回复 '+comment.user.name">
                            </div>
                            <div class="CommentEditor-actions">
                                <button @click="reply(comment)" type="button" class="Button Button--plain">取消</button>
                                <button @click="submitReply(comment)" type="button" class="Button Button--primary Button--blue">评论</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="totalPage>1" class="Pagination comments-pagination">
                    <!-- 上一页 -->
                    <button @click="prevPage" v-if="currentPage != 1" type="button" class="Button PaginationButton PaginationButton-next Button--plain">上一页</button>
                    <!-- 第几页 -->
                    <template v-if="showEllipsis">
                        <button type="button" :class="['Button', 'PaginationButton', 'Button--plain']">1</button>
                        <span v-if="totalPage > 4" class="PaginationButton PaginationButton--fake">...</span>
                        <button disabled type="button" :class="['Button', 'PaginationButton', 'Button--plain', 'PaginationButton--current']">{{currentPage}}</button>
                    </template>
                    <template v-else>
                        <template v-if="totalPage>4">
                            <button  @click="clickNum(page)" v-for="page in 4" :disabled="page==currentPage"  type="button" :class="['Button', 'PaginationButton', 'Button--plain', {'PaginationButton--current': currentPage}]">{{page}}</button>
                        </template>
                        <template v-else>
                            <button @click="clickNum(page)" v-for="page in totalPage" :disabled="page==currentPage"  type="button" :class="['Button', 'PaginationButton', 'Button--plain', {'PaginationButton--current': currentPage}]">{{page}}</button>
                        </template>
                    </template>
                    <span v-if="totalPage > 4" class="PaginationButton PaginationButton--fake">...</span>
                    <button v-if="totalPage > 4" type="button" class="Button PaginationButton Button--plain">{{totalPage}}</button>
                    <button @click="nextPage" v-if="currentPage!=totalPage" type="button" class="Button PaginationButton PaginationButton-next Button--plain">下一页</button>
                </div>
            </div>
            <div :class="['Comments-footer', 'CommentEditor--normal', is_focus ? 'CommentEditor--active' : '']">
                <div :class="['CommentEditor-input', 'Input-wrapper', 'Input-wrapper--spread', 'Input-wrapper--large', is_focus ? 'is_focus' : '']">
                    <input autocomplete="off" v-model="commentText" name="body" @focus="setFocus" type="text" class="Input" placeholder="写下你的评论">
                </div>
                <button @click="submitComment" :disabled="!commentText" class="Button CommentEditor-singleButton Button--primary Button--blue">评论</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true
        },
        type_id: {
            type: Number,
            required: true
        },
        count: {
            type: Number,
            required: true
        },
        defaultShow: {
            default: false
        }
    },
    data () {
        return {
            show: false,
            is_focus: false,
            commentText: "",
            comments: [],
            currentPage: 1,
            loading: false,
            orderBy: 'votes_count',
            comments_count: 0
        }
    },
    computed: {
        totalPage () {
            return Math.ceil(this.comments_count / 5);
        },
        skip () {
            return (this.currentPage-1)*5;
        },
        showEllipsis () {
            return this.currentPage > 4 && this.currentPage < this.totalPage;
        }
    },
    watch: {
        currentPage () {
            this.getComments()
        }
    },
    methods: {
        nextPage () {
            if(this.currentPage < this.totalPage) {
                this.currentPage = this.currentPage + 1;
            }
        },
        clickNum(page) {
            this.currentPage = page;
        },
        prevPage () {
            if(this.currentPage > 1) {
                this.currentPage = this.currentPage - 1;
            }
        },
        reply(comment){
            comment.showReply = !comment.showReply;
        },
        submitReply (comment) {
            axios.post('/comments', {body: comment.text, type: this.type, type_id: this.type_id, to_comment_id: comment.id}).then((response)=>{
                this.getComments();
                this.comments_count += 1;
                try {
                    this.$parent.question.answer.comments_count = this.comments_count;
                    this.$parent.answer.comments_count = this.comments_count;
                } catch (e) {
                }
            });
        },
        toggleOrderBy () {
            this.orderBy = this.orderBy=='votes_count' ? 'created_at' : 'votes_count' ;
            this.getComments();
        },
        setFocus: function () {
            this.is_focus = true;
            setTimeout(()=>{
                $(document).on('click', (e) => {
                    if(!$(e.target).parents('.Comments-footer').length) {
                        this.is_focus = false;
                        $(document).unbind(e);
                    }
                });
            }, 300);
        },
        voteComment (comment) {
            axios.post('/vote/comment', {id: comment.id}).then((response) => {
                const {data} = response;
                if(data.attached.length){
                    comment.votes_count = comment.votes_count + 1;
                    comment.is_vote = true;
                } else {
                    comment.votes_count = comment.votes_count - 1;
                    comment.is_vote = false;
                }
            });
        },
        submitComment () {
            axios.post('/comments', {body: this.commentText, type: this.type, type_id: this.type_id}).then((response)=>{
                if(this.currentPage == this.totalPage) {
                    this.getComments();
                } else {
                    this.currentPage = this.totalPage;
                }
                this.comments_count += 1;
                try {
                    this.$parent.question.answer.comments_count = this.comments_count;
                    this.$parent.answer.comments_count = this.comments_count;
                } catch (e) {

                }
            });
        },
        getComments () {
            this.loading = true;
            axios.post(`/comments/${this.type}/${this.type_id}`, {skip: this.skip, orderBy: this.orderBy}).then((response)=>{
                this.loading = false;
                this.comments = response.data;
            });
        }
    },
    mounted () {
        this.getComments();
        this.comments_count = this.count;
        this.$on('showComment', ()=> {
            this.show = !this.show;
            if(this.show){
                this.getComments();
            }
        });
    }
}
</script>

<style lang="css">
</style>
