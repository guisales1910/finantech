import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['modal'];

    abrir() {

        this.modalTarget.classList.remove('hidden');
        this.modalTarget.classList.add('flex');

    }

    fechar() {
        this.modalTarget.classList.add('hidden');
        this.modalTarget.classList.remove('flex');
    }

    salvarReceita(event) {
        event.preventDefault();

        const form = event.currentTarget;
        const dados = new FormData(form);

        fetch('/receita',{
            method:'POST',
            body: dados
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);
            })
    }


}
