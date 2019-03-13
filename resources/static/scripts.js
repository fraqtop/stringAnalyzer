window.onload = function () {
    let app = new Vue({
        el: '#app',
        data:{
            stringValue: null,
            answer: null
        },
        delimiters: ['[[', ']]'],
        methods:{
            async processData(event) {
                event.preventDefault();
                let formData = new FormData();
                formData.append('string', this.stringValue);
                let result = null;
                let response = await fetch(`/process`,{
                    credentials: 'same-origin',
                    method: 'post',
                    body: formData
                });
                if (response.ok) {
                    result = await response.text();
                }
                this.answer = result;
            },
            async test() {
                let result = await fetch('/test');
                result = await result.text();
                this.answer = result;
            }
        }
    });
};