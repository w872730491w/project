<template lang="html">
    <div class="SearchBar">
        <div class="SearchBar-toolWrapper">
            <form @submit.prevent="setHistory" class="SearchBar-tool">
                <div :class="['SearchBar-input', 'Input-wrapper', 'Input-wrapper--grey', is_focus ? ['SearchBar-focusInput', 'is_focus'] : '']">
                    <input v-model="content" @focus="focus" type="text" maxlength="100" autocomplete="off" class="Input" placeholder="输入您要搜索的内容...">
                    <div class="Input-after">
                        <button :class="['Button', 'SearchBar-searchIcon', 'Button--primary', {'Button--blue': hasContent}]">
                            <svg viewBox="0 0 16 16" class="Icon Icon--search" width="16" height="16" aria-hidden="true" style="height: 16px; width: 16px;">
                                <title></title>
                                <g>
                                    <path d="M12.054 10.864c.887-1.14 1.42-2.57 1.42-4.127C13.474 3.017 10.457 0 6.737 0S0 3.016 0 6.737c0 3.72 3.016 6.737 6.737 6.737 1.556 0 2.985-.533 4.127-1.42l3.103 3.104c.765.46 1.705-.37 1.19-1.19l-3.103-3.104zm-5.317.925c-2.786 0-5.053-2.267-5.053-5.053S3.95 1.684 6.737 1.684 11.79 3.95 11.79 6.737 9.522 11.79 6.736 11.79z">
                                    </path>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <button @click="showQuestionModal" type="button" :class="['Button', 'QuestionAskButton', 'SearchBar-askButton', 'Button--primary', 'Button--blue', is_focus ? 'SearchBar-hideAskButton' : '']">提问</button>
        <transition :duration="{ enter: 350, leave: 200 }" enter-active-class="vivify fadeInTop" leave-active-class="vivify fadeOutTop">
            <div v-show="showSearchBarMenu" style="top: 43px;" class="Popover-content Popover-content--bottom Popover-content--fixed">
                <div class="Menu AutoComplete-menu SearchBar-menu SearchBar-noValueMenu">
                    <!-- <div class="AutoComplete-group">
                        <div class="SearchBar-label">知乎热搜</div>
                        <div class="Menu-item" role="option">
                            <div data-za-module="TopNavBar">
                                <div data-za-module="HotSearchWordList">
                                    <div class="SearchBar-topSearchItem" data-za-detail-view-path-module="HotSearchWordItem">MH370<svg class="Zi Zi--Hot SearchBar-hotIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><defs><linearGradient id="id-2014200654-a" x1="63.313%" x2="46.604%" y1="-13.472%" y2="117.368%"><stop offset="2.35%" stop-color="#EC471E"></stop><stop offset="100%" stop-color="#FF6DC4"></stop></linearGradient></defs><path fill="url(#id-2014200654-a)" d="M14.553 20.78c.862-.651 1.39-1.792 1.583-3.421.298-2.511-.656-4.904-2.863-7.179.209 2.291.209 3.73 0 4.314-.41 1.143-1.123 1.983-1.91 2.03-1.35.079-2.305-.512-2.863-1.774-.676 1.25-.782 2.556-.318 3.915.31.906.94 1.684 1.89 2.333C7.144 20.131 5 17.336 5 14.022c0-2.144.898-4.072 2.325-5.4.062 2.072.682 3.598 2.13 4.822-.67-1.112-.734-2.11-.734-3.517 0-3.253 2.067-6.007 4.913-6.927a7.35 7.35 0 0 0 2.157 4.918C17.722 9.214 19 11.463 19 14.022c0 3.073-1.844 5.7-4.447 6.758z" fill-rule="evenodd"></path></svg></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="AutoComplete-group">
                        <div class="SearchBar-label SearchBar-label--history">
                            搜索历史
                            <div @click="clearHistory" class="SearchBar-historyIconWrapper"><span class="SearchBar-historyIconShade preventCloseOnTarget"></span><span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--TrashOutline" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M16.213 18.638h-7.83V8.085H7.021v10.553c0 .751.611 1.362 1.362 1.362h7.83c.75 0 1.361-.61 1.361-1.362V8.085h-1.361v10.553zM15.19 5.362c0-.751-.61-1.362-1.361-1.362h-3.064c-.751 0-1.362.61-1.362 1.362v.68H6.766S6 6 6 6.715c0 .714.766.69.766.69H17.89s.705 0 .705-.688c0-.689-.705-.673-.705-.673h-2.7v-.681zm-1.361.68h-3.064v-.68h3.064v.68zm-3.745 3.064v8.17h1.362v-8.17h-1.362zm3.064 0v8.17h1.362v-8.17h-1.362z" fill-rule="evenodd"></path></svg></span>清空</div>
                        </div>
                        <div v-for="(item, index) of historyList" class="Menu-item">
                            <div class="SearchBar-historyItem">
                                <span class="SearchBar-historyItemContent">
                                    <span><em></em>{{item.content}}</span>
                                </span>
                                <div @click="deleteHistory(index)" class="SearchBar-historyIconWrapper SearchBar-historyDelete">
                                    <span class="preventCloseOnTarget SearchBar-historyIconShade"></span>
                                    <svg class="Zi Zi--Close" width="18" height="18" fill="#d3d3d3" viewBox="0 0 24 24"><path d="M13.486 12l5.208-5.207a1.048 1.048 0 0 0-.006-1.483 1.046 1.046 0 0 0-1.482-.005L12 10.514 6.793 5.305a1.048 1.048 0 0 0-1.483.005 1.046 1.046 0 0 0-.005 1.483L10.514 12l-5.208 5.207a1.048 1.048 0 0 0 .006 1.483 1.046 1.046 0 0 0 1.482.005L12 13.486l5.207 5.208a1.048 1.048 0 0 0 1.483-.006 1.046 1.046 0 0 0 .005-1.482L13.486 12z" fill-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                is_focus: false,
                showSearchBarMenu: false,
                content: "",
                historyList: []
            }
        },
        watch: {
            is_focus () {
                if(this.is_focus) {
                    setTimeout(function () {
                        $(document).on('click', ':not(.SearchBar)', function (e) {
                            if(!$(e.target).parents('.SearchBar').length){
                                this.showSearchBarMenu = false;
                                this.is_focus = false;
                            }
                            e.stopPropagation();
                        }.bind(this));
                    }.bind(this), 300);
                }
            }
        },
        computed: {
            hasContent () {
                return !this.is_focus && this.content;
            }
        },
        methods: {
            setHistory () {
                if(window.localStorage){
                    const ls = localStorage;
                    this.historyList.push({
                        content: this.content
                    });
                    ls.setItem('searchHistory', JSON.stringify(this.historyList));
                }
                location.href="/search?q="+this.content;
            },
            deleteHistory (index) {
                this.historyList.splice(index, 1);
                localStorage.setItem('searchHistory', JSON.stringify(this.historyList));
            },
            clearHistory () {
                this.historyList = [];
                localStorage.setItem('searchHistory', JSON.stringify(this.historyList));
            },
            focus () {
                this.is_focus = true;
                this.showSearchBarMenu = true;
            },
            showQuestionModal() {
                this.bus.$emit('showQuestionModal');
            }
        },
        mounted () {
            if(window.localStorage){
                const ls = localStorage;
                let data = JSON.parse(ls.getItem('searchHistory'));
                if(!data){
                    ls.setItem('searchHistory', '[]');
                    let data = JSON.parse(ls.getItem('searchHistory'));
                }
                this.historyList = data;
            }
        }
    }
</script>

<style lang="css">
    .SearchBar {
        display: flex;
    }

    .SearchBar-toolWrapper {
        position: relative;
        z-index: 104;
        width: 326px;
    }

    .SearchBar-askButton {
        z-index: 103;
        padding: 0 14px;
        margin-left: 16px;
        transition: opacity .3s ease, -webkit-transform .3s ease;
        transition: opacity .3s ease, transform .3s ease;
        transition: opacity .3s ease, transform .3s ease, -webkit-transform .3s ease;
        line-height: 30px;
    }

    .SearchBar-hideAskButton {
        opacity: 1;
        transform: scale(0);
    }

    .SearchBar-tool {
        position: relative;
        float: left;
        overflow: hidden;
    }

    .SearchBar-input {
        width: 326px;
        padding-left: 16px;
        transition: width .2s ease, background .3s ease;
    }

    .SearchBar-searchIcon {
        position: absolute;
        right: -11px;
        top: -17px;
        bottom: -17px;
        background: transparent;
        border: transparent;
        padding: 0 12px;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        transition: fill .3s ease;
    }

    .SearchBar-focusInput {
        width: 400px;
    }

    .SearchBar-focusInput .Icon {
        fill: #0084ff;
    }

    .SearchBar-menu {
        width: 400px;
        padding-bottom: 0;
        overflow-x: hidden;
    }

    .SearchBar-menu.SearchBar-noValueMenu {
        padding-bottom: 8px;
    }

    .SearchBar-label {
        padding: 7px 0;
        margin-right: 16px;
        margin-left: 16px;
        font-size: 14px;
        color: #8590a6;
        border-bottom: 1px solid #ebebeb;
    }

    .SearchBar-menu .Menu-item {
        padding: 0 16px;
    }

    .SearchBar-topSearchItem {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    font-size: 14px;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 4px 0;
    height: 32px;
    box-sizing: border-box;
    margin: 2px 0;
}

.SearchBar-label--history {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}

.SearchBar-historyIconShade {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.SearchBar-historyIconWrapper:hover, html[data-theme=dark] .SearchBar-historyIconWrapper:hover {
    color: #175199;
}

.SearchBar-historyItem {
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    font-size: 14px;
    padding: 6px 0;
    line-height: 24px;
}

.SearchBar-historyItem, .SearchBar-historyItemContent {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.SearchBar-historyItem, .SearchBar-historyItemContent {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.SearchBar-historyIconWrapper {
    position: relative;
}

.SearchBar-historyDelete {
    display: none;
}

.SearchBar-historyIconShade {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.SearchBar-historyIconWrapper svg {
    fill: #8590a6;
}

.SearchBar-historyItem:hover .SearchBar-historyDelete {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.SearchBar-menu .Menu-item:hover {
    background: #f6f6f6;
}
</style>
