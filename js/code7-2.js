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

class Bookshelf {
  constructor() {
    this._books = [];
  }

  addBook(book) {
    this._books.push(book);
  }

  findBookByTitle(title) {
    for(let i = 0; i < this._books.length; i++) {
      if (this._books[i].getTitle() === title) return this._books[i];
    }
    return null;
  }

  sumPageSize() {
    let size = 0;
    for(let i = 0; i < this._books.length; i++) {
      size += this._books[i].getPageSize();
    }
    return size;
  }
}

let bookshelf = new Bookshelf;

bookshelf.addBook(new ImmutableBook("坊ちゃん", 520));
bookshelf.addBook(new ImmutableBook("我輩は猫である", 454));
bookshelf.addBook(new ImmutableBook("こころ", 876));

console.log(bookshelf.findBookByTitle("こころ"));
console.log(bookshelf.sumPageSize());
