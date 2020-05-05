// 変更不可能な本
class ImmutableBook {
  constructor(title, pageSize) {
    //便宜上、"_"で始まるインスタンス変数はプライベート変数として扱います
    this._title = title;
    this._pageSize = pageSize;
  }

  getTitle() {
    return this._title;
  }

  getPageSize() {
    return this._pageSize;
  }
}

let book = new ImmutableBook("坊ちゃん", 520);

// もちろん以下アクセスはエラーにならないですが
// コーディング規約として「この書き方をしてはいけない」として進めます。
console.log(book._title);
console.log(book._pageSize);

// もしも上記と同じことがしたければ以下のように呼べます。
console.log(book.getTitle());
console.log(book.getPageSize());

// この規約では下記はもう書いてはいけない（と、取り決めた）コードです。
// book._title = "それから";

// つまりこのコードのBookクラスは、インスタンス化した後、変更することができません。
// プログラムのバグは値の変更の結果起こることが殆どなので、セッターの無いImmutableBookは
// これまで扱ってきたBookよりも堅牢です。