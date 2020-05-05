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
  constructor(books) {
    this._books = books; // 厳密には危険
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

  getBooks() {
    return this._books; // 厳密には危険
  }
}

let books = [];
let bookshelf = new Bookshelf(books);

bookshelf.addBook(new ImmutableBook("坊ちゃん", 520));
bookshelf.addBook(new ImmutableBook("我輩は猫である", 454));
bookshelf.addBook(new ImmutableBook("こころ", 876));

// こんな変更ができてしまいます。
// 1. Bookshelfに渡したbooksを直接操作
books.splice(0, books.length - 1); // 最後の一つを残して全部消す!!
console.log(bookshelf.getBooks());

// 2. Bookshelfから取り出したbooksを直接操作
let innnerBooks = bookshelf.getBooks();
books.splice(0, books.length); // 全部消す!!
console.log(bookshelf.getBooks());
