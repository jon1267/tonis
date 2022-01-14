<template>
    <div class="container mobile-app">

        <img src="/images/pdparis-black-logo.png">
        <p>Шаг: {{ step }}</p>

        <div v-if="step === 1" class="step">
            <h1>Бонжур!</h1>
            <p>Дайте відповідь всього на 5 питань, а я підберу для вас персональний аромат та подарую знижку до 90% на весь асортимент.</p>
            <p><small>*Знижка діє тільки в оффлайн-магазині.</small></p>

            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 2" class="step">
            <h1>Давайте знайомитись — вкажіть ваші стать та вік</h1>
            <p>Це важливі критерії у виборі персонального аромату, який надалі стане вашою візитною карткою.</p>
            <p><input type="radio" v-model="answers.sex" value="мужской"> мужской</p>
            <p><input type="radio" v-model="answers.sex" value="женский"> женский</p>
            <p><input type="text"  v-model="answers.age"> возвраст</p>

            <button :disabled="loading" @click="decreaseStep()">Назад</button>
            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 3" class="step">
            <h1>Який у вас тип характеру?</h1>
            <p>Парфуми мають віддзеркалювати внутрішнє «я» свого власника, тому важливо підкреслити ароматними нотами саме ваші риси характеру.</p>
            <p><input type="radio" v-model="answers.temperament" value="меланхолик"> Меланхолик - ранимый, сдержанный в речи человек. Они обладают высокой чувствительностью нервной системы, что присуще творческим натурам </p>
            <p><input type="radio" v-model="answers.temperament" value="холерик"> Холерик - горячий, импульсивный, стремительно реагирующий на ситуацию</p>
            <p><input type="radio" v-model="answers.temperament" value="флегматик"> Флегматик - медлительный, спокойный, с постоянным настроением</p>
            <p><input type="radio" v-model="answers.temperament" value="сангвиник"> Сангвиник - отличается высокой работоспособностью, энергичностью и порой слишком легким отношением к проблемам</p>

            <button :disabled="loading" @click="decreaseStep()">Назад</button>
            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 4" class="step">
            <h1>Яку пору року ви полюбляєте найбільше?</h1>
            <p>Таким чином я зможу визначити, наскільки насиченим має бути ваш аромат.</p>
            <p><input type="radio" v-model="answers.time" value="зима"> зима </p>
            <p><input type="radio" v-model="answers.time" value="весна"> весна</p>
            <p><input type="radio" v-model="answers.time" value="лето"> лето</p>
            <p><input type="radio" v-model="answers.time" value="осень"> осень</p>

            <button :disabled="loading" @click="decreaseStep()">Назад</button>
            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 5" class="step">
            <h1>Ващ знак зодіаку?</h1>
            <p><input type="radio" v-model="answers.zodiac" value="Овен"> Овен </p>
            <p><input type="radio" v-model="answers.zodiac" value="Телець"> Телець</p>
            <p><input type="radio" v-model="answers.zodiac" value="Близнята"> Близнята</p>
            <p><input type="radio" v-model="answers.zodiac" value="Рак"> Рак</p>
            <p><input type="radio" v-model="answers.zodiac" value="Лев"> Лев</p>
            <p><input type="radio" v-model="answers.zodiac" value="Діва"> Діва</p>
            <p><input type="radio" v-model="answers.zodiac" value="Терези"> Терези</p>
            <p><input type="radio" v-model="answers.zodiac" value="Скорпіон"> Скорпіон</p>
            <p><input type="radio" v-model="answers.zodiac" value="Стрілець"> Стрілець</p>
            <p><input type="radio" v-model="answers.zodiac" value="Козоріг"> Козоріг</p>
            <p><input type="radio" v-model="answers.zodiac" value="Водолій"> Водолій</p>
            <p><input type="radio" v-model="answers.zodiac" value="Риби"> Риби</p>

            <button :disabled="loading" @click="decreaseStep()">Назад</button>
            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 6" class="step">
            <h1>Розкажіть мені про ваш улюблений аромат?</h1>
            <p>Я знайду схожі композиції, щоб урізноманітнити ваш парфумерний гардероб. Вкажіть у формі нижче, що вас приваблює в ароматах.
            </p>
            <p><textarea v-model="answers.notes"></textarea></p>

            <button :disabled="loading" @click="decreaseStep()">Назад</button>
            <button :disabled="loading" @click="increaseStep()">Далі</button>
        </div>

        <div v-if="step === 7" class="step">
            <h1>Вітаю! Ви успішно пройшли тест :)</h1>
            <button :disabled="loading" @click="increaseStep()">Результат</button>
        </div>

        <div v-if="step === 8" class="step">
            <h1 v-if="loading">Проше чекайте...</h1>
            <div v-else>
                <h1>Ваша знижка: {{ result.percent }}%</h1>
                <p>Код знижки: {{ result.code }}</p>
                <button :disabled="loading" @click="increaseStep()">Вислати по СМС</button>
            </div>
        </div>

        <div v-if="step === 9" class="step">
            <h1>Вислати знижку по СМС</h1>
            <input v-mask="'+38 (###) ###-##-##'" type="tel" name="phone" v-model="phone">
            <button :disabled="loading" @click="sendSms()">Вислати</button>
        </div>

        <div v-if="step === 10" class="step">
            <h1 v-if="loading">Проше чекайте...</h1>
            <div v-else>
                <h1>Перевірте телефон</h1>

                <p>Ваша знижка: {{ result.percent }}%</p>
                <p>Код знижки: {{ result.code }}</p>

                <h2>Парфуми для вас:</h2>

                <div v-for="row in result.parfumes">
                    <img :src="['https://parfumdeparis.biz/assets/img/landing_good/' + row.img]">
                    <p>{{ row.bname}} {{ row.name }}</p>
                </div>
            </div>

        </div>

    </div>
</template>

<script>

export default {
    props: [
        'pointId',
    ],
    data () {
        return {
            step: 1,
            phone: '',
            hash: null,
            result: {},
            loading: false,
            answers: {
                sex: 'женский',
                age: 1,
                aromat: [],
                temperament: 'меланхолик',
                zodiac: 'Овен',
                time: 'зима',
                notes: '',
            },
        }
    },

    mounted() {

        this.step = 1;

        let phone = this.$cookies.get('phone');
        if (phone) {
            this.phone = phone;
        }

        let hash = this.$cookies.get('hash');
        if (hash) {
            this.hash = hash;
        }

        let answers = this.$cookies.get('answers');
        if (answers) {
            this.answers = answers;
        }

        let step = this.$cookies.get('step');
        if (step) {
            this.step = parseInt(step);
        }
    },

    watch: {
        hash: function () {
            let that = this;
            that.loading = true;
            return axios.get('/api/promocodes/' + that.hash)
                .then(result => {
                    that.result = result.data;
                    that.loading = false;
                })
                .catch(error => {
                    that.loading = false;
                });
        },

        step: function () {

            this.$cookies.set('step', this.step);
            this.$cookies.set('answers', this.answers);

            if (this.step === 8) {
                if (this.hash) {
                    return true;
                }

                let that = this;
                that.loading = true;
                return axios.post('/api/promocodes', {
                   answers: that.answers,
                   point_id: that.pointId,
                   phone: that.phone,
                })
                    .then(result => {
                        that.result = result.data;
                        that.$cookies.set('hash', that.result.hash);

                        setTimeout(function () {
                           that.loading = false;
                        }, 1000);
                    })
                    .catch(error => {
                       that.loading = false;
                    });
            }
        },
    },

    methods: {
        sendSms() {
            let that = this;
            that.loading = true;

            if (that.phone.length < 10) {
                return false;
            }

            that.loading = true;
            return axios.post('/api/promocodes/send', {
                hash: that.hash,
                phone: that.phone,
            })
                .then(result => {
                    that.$cookies.set('phone', that.phone);
                    that.increaseStep();
                    that.loading = false;
                })
                .catch(error => {
                    that.loading = false;
                });
        },

        increaseStep() {
            this.step++;
        },

        decreaseStep() {
            this.step--;
        }
    }
}
</script>
<style lang="scss">
    .mobile-app {
        text-align:center;
        max-width:760px;
        min-width:320px;
        width:100%;
        margin: 0 auto;
        border: 1px dashed silver;
        padding: 10px;
    }
</style>
