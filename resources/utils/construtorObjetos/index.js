export class BaseField {
    constructor(label, placeholder, tipo, obrigatorio, valor, erros = [], icone = "", hint = '') {
        this.label = label;
        this.placeholder = placeholder;
        this.tipo = tipo;
        this.obrigatorio = obrigatorio;
        this.valor = valor;
        this.erros = erros;
        this.icone = icone;
        this.hint = hint;
    }
}

export class Select extends BaseField {
    constructor(
        label,
        placeholder,
        tipo = "select",
        obrigatorio,
        multiplo,
        valor,
        erros = [],
        selectText = "nome",
        itens = [],
        funcao = null,
    ) {
        super(label, placeholder, tipo, obrigatorio, valor, erros);
        this.multiplo = multiplo;
        this.itens = itens;
        this.selectText = selectText;
    }
}

export class TableHeader {
    constructor(text, align, sortable, value) {
        this.text = text;
        this.align = align;
        this.sortable = sortable;
        this.value = value;
    }
}
