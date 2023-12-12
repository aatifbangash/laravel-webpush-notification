import './App.css'

function App() {
    return (
        <>
            <nav className="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div className="container">
                    <div className="navbar-header">
                        <button
                            type="button"
                            className="navbar-toggle"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                            <span className="sr-only">Toggle navigation</span>
                            <span className="icon-bar"></span>
                            <span className="icon-bar"></span>
                            <span className="icon-bar"></span>
                        </button>
                        <a className="navbar-brand" href="index.html">Simple Blog</a>
                    </div>
                    <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul className="nav navbar-nav navbar-right">
                            <li>
                                <a href="about.html">About</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="signup.html">Sign up</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <h2 className="post-title">
                            <a href="post.html">Blog Post Title</a>
                        </h2>
                        <p className="lead">
                            by Author
                        </p>
                        <p><span className="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora,
                            necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id
                            animi corrupti debitis ipsum officiis rerum.</p>
                        <a className="btn btn-default" href="post.html">Read More</a>
                        <hr/>
                        <h2 className="post-title">
                            <a href="post.html">Blog Post Title</a>
                        </h2>
                        <p className="lead">
                            by Author
                        </p>
                        <p><span className="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM
                        </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat,
                            asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora
                            ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                        <a className="btn btn-default" href="post.html">Read More</a>
                        <hr/>
                        <h2 className="post-title">
                            <a href="post.html">Blog Post Title</a>
                        </h2>
                        <p className="lead">
                            by Author
                        </p>
                        <p><span className="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45
                            PM</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates,
                            voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto
                            itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                        <a className="btn btn-default" href="post.html">Read More</a>
                        <hr/>
                        <ul className="pager">
                            <li className="previous">
                                <a href="#">Prev</a>
                            </li>
                            <li className="next">
                                <a href="#">Next</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <footer>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-12">
                            <p>Copyright &copy; Your Website 2014</p>
                        </div>
                    </div>
                </div>
            </footer>
        </>
    )
}

export default App
