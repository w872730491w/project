<template lang="html">
    <div class="Ask">
        <form action="/question" method="POST" class="Ask-form">
            <input type="hidden" name="_token" :value="token">
            <div class="Ask-items">
                <div class="Ask-item">
                    <div class="Input-wrapper Input-wrapper--spread Input-wrapper--large">
                        <textarea name="title" required="" rows="1" autocomplete="off" class="Input" placeholder="问题标题"></textarea>
                    </div>
                </div>
                <div class="Ask-item">
                    <select class="Input select2" name="topics[]" multiple="multiple"></select>
                </div>
                <div class="Ask-item">
                    <editable></editable>
                </div>
            </div>
            <div class="Ask-footer">
                <div class="AskOptions">
                    <label for="anonymous-checkbox" class="AskOptions-label">
                        <input name="anonymous" id="anonymous-checkbox" class="AskOptions-checkbox" type="checkbox" value="true">匿名提问
                    </label>
                </div>
                <button class="Button Button--primary Button--blue">发布问题</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            token: $('meta[name="csrf-token"]').attr('content')
        }
    },
    mounted () {

        $('.select2').select2({
            tags: true,
            multiple: true,
            placeholder: '选择相关话题',
            ajax: {
                url: '/api/topics',
                dataType: 'json',
                delay: 0,
                type: 'POST',
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
        });
    }
}
</script>

<style lang="css">
</style>
