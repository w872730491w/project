<template lang="html">
    <div v-if="show" @mouseover="handleOver" @mouseleave="handleLeave" :style="style" class="Popover-content Popover-content--bottom HoverCard-popoverTarget">
        <div class="HoverCard-container">
            <div v-if="loading" class="HoverCard-loading" style="left: 12px; top: 0px;">
                <div class="BounceLoading" style="width: 60px; height: 18px;">
                    <span class="BounceLoading-child" style="top: 6px; left: 0px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: 0s;"></span>
                    <span class="BounceLoading-child" style="top: 6px; left: 18px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.1s;"></span>
                    <span class="BounceLoading-child" style="top: 6px; left: 36px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.2s;"></span>
                    <span class="BounceLoading-child" style="top: 6px; left: 54px; width: 6px; height: 6px; animation-duration: 0.8s; animation-delay: -0.3s;"></span>
                </div>
            </div>
            <div v-if="!loading" :class="['HoverCard', {'HoverCard--isLoading': loading }]">
                <div class="HoverCard-titleContainer">
                    <img class="Avatar Avatar--large HoverCard-avatar" width="68" height="68" :src="user.avatar" :srcset="`${user.avatar} 2x`">
                    <div class="HoverCard-titleText">
                        <div class="HoverCard-title">
                            <span>
                                <a target="_blank" :href="`/people/${user.id}`">{{user.name}}</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="HoverCard-item">
                    <div class="NumberBoard">
                        <a target="_blank" type="button" class="Button NumberBoard-item Button--plain" href="">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">回答</div>
                                <strong class="NumberBoard-itemValue" :title="user.answers_count">{{user.answers_count}}</strong>
                            </div>
                        </a>
                        <a target="_blank" type="button" class="Button NumberBoard-item Button--plain" href="">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">问题</div>
                                <strong class="NumberBoard-itemValue" :title="user.questions_count">{{user.questions_count}}</strong>
                            </div>
                        </a>
                        <a target="_blank" type="button" class="Button NumberBoard-item Button--plain" href="">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">关注者</div>
                                <strong class="NumberBoard-itemValue" :title="user.followings_count">{{user.followings_count}}</strong>
                            </div>
                        </a>
                    </div>
                    <div v-if="!user.is_self" class="MemberButtonGroup ProfileButtonGroup HoverCard-buttons">
                        <button @click="followUser" v-if="!user.is_follow" type="button" class="Button FollowButton Button--primary Button--blue">
                            <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Plus FollowButton-icon" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M13.491 10.488s-.012-5.387 0-5.998c-.037-1.987-3.035-1.987-2.997 0-.038 1.912 0 5.998 0 5.998H4.499c-1.999.01-1.999 3.009 0 3.009s5.995-.01 5.995-.01v5.999c0 2.019 3.006 2.019 2.997 0-.01-2.019 0-5.998 0-5.998s3.996.009 6.004.009c2.008 0 2.008-3-.01-3.009h-5.994z" fill-rule="evenodd"></path></svg></span>
                            关注他
                        </button>
                        <button @click="followUser" v-else type="button" class="Button FollowButton Button--primary Button--grey">
                            已关注
                        </button><button @click="sendMessage" type="button" class="Button Button--grey Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Comments Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M11 2c5.571 0 9 4.335 9 8 0 6-6.475 9.764-11.481 8.022-.315-.07-.379-.124-.78.078-1.455.54-2.413.921-3.525 1.122-.483.087-.916-.25-.588-.581 0 0 .677-.417.842-1.904.064-.351-.14-.879-.454-1.171A8.833 8.833 0 0 1 2 10c0-3.87 3.394-8 9-8zm10.14 9.628c.758.988.86 2.009.86 3.15 0 1.195-.619 3.11-1.368 3.938-.209.23-.354.467-.308.722.12 1.073.614 1.501.614 1.501.237.239-.188.562-.537.5-.803-.146-1.495-.42-2.546-.811-.29-.146-.336-.106-.563-.057-2.043.711-4.398.475-6.083-.927 5.965-.524 8.727-3.03 9.93-8.016z" fill-rule="evenodd"></path></svg></span>
                            发私信
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            show: false,
            style: {},
            loading: true,
            user: {},
            timeOut: null
        };
    },
    methods: {
        showHoverCard (obj) {
            if(obj.id) {
                this.loading = true;
                this.show = true;
                this.style = obj.style;
                axios.post('/getUserCardInfo', {id: obj.id}).then((response) => {
                    this.loading = false;
                    this.user = response.data;
                });
            }
        },
        sendMessage () {
            window.app.$refs.sendMessage.$emit('showModal', this.user);
        },
        followUser () {
            axios.post('/follow/user', {id: this.user.id}).then((response)=>{
                if(response.data.attached.length){
                    this.user.followings_count = this.user.followings_count + 1;
                } else {
                    this.user.followings_count = this.user.followings_count - 1;
                }
                this.user.is_follow = !this.user.is_follow;
            });
        },
        closeHoverCard (timeout) {
            this.show = false;
        },
        handleOver () {
            if(this.timeOut) {
                clearTimeout(this.timeOut);
            }
            this.show = true;
        },
        handleLeave () {
            this.show = false;
        }
    },
    mounted () {
        this.$on('showHoverCard', this.showHoverCard);
        this.$on('closeHoverCard', this.closeHoverCard);
    }
}
</script>

<style lang="css">
.HoverCard-coverContainer {
	height: 100px;
	margin: 0 -12px;
	overflow: hidden;
	border-radius: 2px 2px 0 0
}

.HoverCard-cover {
	width: 100%;
	height: 100%;
	-o-object-fit: cover;
	object-fit: cover
}

.HoverCard-subtitle,.HoverCard-title {
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap
}

.HoverCard-title {
	font-size: 16px;
	font-weight: 500
}

.HoverCard-subtitle {
	margin-top: 4px;
	font-weight: 400
}

.HoverCard-titleContainer {
	position: relative;
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	padding: 8px 0;
	border-bottom: 1px solid #f6f6f6;
	-webkit-box-align: center;
	-ms-flex-align: center;
	align-items: center
}

.HoverCard-titleContainer--noAvatar {
	margin-top: 20px
}

.HoverCard-avatar {
	position: absolute;
	top: -20px;
	border: 2px solid #fff
}

.HoverCard-titleText {
	display: flex;
	min-height: 42px;
	padding-bottom: 2px;
	margin-left: 84px;
	flex-direction: column;
	justify-content: center;
	overflow: hidden;
	flex: 1
}

.HoverCard-attrInfo {
	margin-left: 10px;
	color: #8590a6;
	white-space: nowrap
}

.HoverCard-attrInfo .Icon {
	margin-right: 8px
}

html[data-theme=dark] .HoverCard-attrInfo {
	color: #606a80
}

.HoverCard {
	padding: 0 12px 16px;
	font-size: 14px;
	opacity: 1;
	transition: opacity .3s ease
}

.HoverCard--isLoading {
	opacity: 0
}

.HoverCard,.HoverCard-loading {
	box-shadow: 0 5px 20px rgba(26,26,26,.1);
	background: #fff;
	border-radius: 2px
}

.HoverCard-container {
	width: 360px;
	max-height: 600px
}

.HoverCard-loading {
	position: absolute;
	width: 120px;
	height: 80px;
	display: flex;
	justify-content: center;
	align-items: center;
	margin: auto
}

.HoverCard-loading--reversed {
	transform: translateY(-100%)
}

.HoverCard-container--large {
	width: 400px
}

.HoverCard-numberBoard {
	display: flex;
	justify-content: space-around;
	align-items: center
}

.HoverCard-buttons {
	margin-top: 16px
}

.HoverCard-buttons .Button {
	width: 144px
}

.HoverCard-numberGroup {
	flex: 1
}

.HoverCard-boardKey {
	line-height: 1.7;
	color: #8590a6
}

html[data-theme=dark] .HoverCard-boardKey {
	color: #606a80
}

.HoverCard-boardNumber {
	margin-top: 4px;
	font-size: 18px;
	font-weight: 500;
	line-height: 1.4;
	color: #1a1a1a
}

html[data-theme=dark] .HoverCard-boardNumber {
	color: #999
}

.HoverCard-item {
	padding: 8px 0;
	line-height: 1.75;
	border-bottom: 1px solid #f6f6f6
}

.HoverCard-item:last-child {
	padding: 8px 16px;
	text-align: center;
	border: 0
}

.HoverCard-item .Icon {
	margin-right: 8px
}

html[data-theme=dark] .HoverCard-item {
	border-bottom: 1px solid #2e2e2e
}

.HoverCard-description {
	display: block;
	display: -webkit-box;
	max-height: 73.5px;
	overflow: hidden;
	text-overflow: ellipsis;
	-webkit-line-clamp: 3;
	-webkit-box-orient: vertical
}

.HoverCard-separate {
	color: #ebebeb
}

html[data-theme=dark] .HoverCard-separate {
	color: #444
}

.HoverCard-popoverTarget {
	border-width: 0;
	background: transparent;
	box-shadow: none
}

.HoverCard-numberGroup {
	-webkit-box-flex: 1;
	-ms-flex: 1;
	flex: 1
}

.MemberButtonGroup .Button+.Button {
	margin-left: 16px
}

.MemberButtonGroup-prohibitIcon {
	fill: currentColor;
	margin-right: 4px
}
</style>
