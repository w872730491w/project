<template lang="html">
    <div class="List-item">
        <div class="ContentItem AnswerItem">
            <div class="ContentItem-meta">
                <div class="AuthorInfo AnswerItem-authorInfo AnswerItem-authorInfo--related">
                    <div :user-id="answer.user_id" class="UserLink AuthorInfo-avatarWrapper">
                        <a class="UserLink-link" target="_blank" :href="userLink">
                            <img class="Avatar AuthorInfo-avatar" width="38" height="38" :src="avatar" :srcset="`${avatar} 2x`" :alt="userName">
                        </a>
                    </div>
                    <div class="AuthorInfo-content">
                        <div class="AuthorInfo-head">
                            <div :user-id="answer.user_id" class="UserLink AuthorInfo-name">
                                <a class="UserLink-link" target="_blank" :href="userLink">
                                    {{userName}}
                                </a>
                            </div>
                        </div>
                        <div class="AuthorInfo-detail">
                            <div class="AuthorInfo-badge">
                                <div class="RichText ztext AuthorInfo-badgeText">{{introduction}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="AnswerItem-extraInfo">
                    <div class="Voters">
                        <button type="button" class="Button Button--plain">
                            {{answer.votes_count}} 人赞同了该回答
                        </button>
                    </div>
                </div>
                <div :class="['RichContent', 'RichContent--unescapable', {'is-collapsed': is_collapsed}]">
                    <div class="RichContent-inner">
                        <div class="RichText ztext CopyrightRichText-richText" v-html="answer.body"></div>
                    </div>
                    <button @click="is_collapsed=false" v-if="is_collapsed" type="button" class="Button ContentItem-rightButton Button--plain">展开阅读全文<svg viewBox="0 0 10 6" class="Icon ContentItem-arrowIcon Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg></button>
                    <div class="ContentItem-actions">
                        <span>
                            <button :disabled="answer.is_self" @click="voteAnswer" aria-label="赞同" type="button" :class="['Button', 'VoteButton', 'VoteButton--up', {'is-active': answer.is_vote}]">
                                <span style="display: inline-flex; align-items: center;">
                                    ​<svg class="Zi Zi--TriangleUp VoteButton-TriangleUp" fill="currentColor" viewBox="0 0 24 24" width="10" height="10"><path d="M2 18.242c0-.326.088-.532.237-.896l7.98-13.203C10.572 3.57 11.086 3 12 3c.915 0 1.429.571 1.784 1.143l7.98 13.203c.15.364.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H3.955c-1.08 0-1.955-.517-1.955-1.9z" fill-rule="evenodd"></path></svg>
                                </span>
                                <template v-if="answer.is_vote">已</template>赞同
                                <template v-if="answer.votes_count">
                                    {{answer.votes_count}}
                                </template>
                            </button>
                        </span>
                        <button @click="toggleComment" type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg>
                            </span>
                            <template v-if="answer.comments_count">
                                {{answer.comments_count}} 条评论
                            </template>
                            <template v-else>
                                添加评论
                            </template>
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg>
                            </span>
                            分享
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Star Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg>
                            </span>
                            收藏
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Heart Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z" fill-rule="evenodd"></path></svg>
                            </span>
                            感谢
                        </button>
                        <button @click="is_collapsed=true" v-if="!is_collapsed" type="button" class="Button ContentItem-rightButton Button--plain">
                            收起
                            <svg viewBox="0 0 10 6" class="Icon ContentItem-arrowIcon is-active Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
                        </button>
                    </div>
                </div>
                <comments type="answer" :type_id="answer.id" ref="comment" :count="answer.comments_count"></comments>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        answer: {
            type: Object,
            required: true
        }
    },
    data () {
        return {
            is_collapsed: false,
            is_showComment: false,
        };
    },
    methods: {
        voteAnswer () {
            axios.post('/vote/answer', {id: this.answer_id}).then((response) => {
                this.answer.is_vote = !this.answer.is_vote;
                this.answer.votes_count += response.data.attached.length ? 1 : -1 ;
            });
        },
        toggleComment () {
            this.$refs.comment.$emit('showComment');
            this.is_showComment = this.$refs.comment.show;
        }
    },
    computed: {
        answer_id () {
            return this.answer.id;
        },
        userLink () {
            return '/people/' + this.answer.user_id;
        },
        userName () {
            return this.answer.user.name;
        },
        avatar () {
            return this.answer.user.avatar;
        },
        introduction () {
            return this.answer.user.profile.introduction;
        }
    }
}
</script>

<style lang="css">
</style>
