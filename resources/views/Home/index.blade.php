@extends('main')

@section('content')
    <div id="panel"></div>

    <!--
    @foreach ( $posts as $p )
        <div class="card bg-dark text-white">
            <img src="{{Storage::url($p->picture)}}" class="card-img" alt="...">
            <div class="card-img-overlay">
            <h5 class="card-title">{{$p->title}}</h5>
            <p class="card-text">
                Category: 
                @foreach ( $p->tags as $t )
                    {{$t->name}}&nbsp;&nbsp;
                @endforeach
            </p>
            </div>
        </div>
        <br/>
    @endforeach
    -->
    
    
@endsection

@section('footerJS')
    @parent
    <script  type="text/babel">
        /*
        (function (){
            console.log({!! json_encode($tags->toArray()) !!});
            
        })();
        */
        class TagFilter extends React.Component{
            render(){
                return this.props.tags.map(t=>(
                        <button onClick={(e) => this.props.setFilter(t.id) } type="button" key={t.id} className="btn btn-primary">
                            {t.name}
                        </button>  
                    )); 
            }
        }
        class ArticleTag extends React.Component{
            render(){
                return this.props.tags.map(t=>(
                    <span key={t.id}>{t.name}</span>
                )); 
            }
        }
        class ArticleList extends React.Component{
            render(){
                return this.props.posts.map(p=>(

                    <div key={p.id} className="card bg-dark text-white">
                        <a href={ '/posts/'+p.id }>
                            <img src={ '/storage/'+p.picture } className="card-img" alt="..." />
                            <div className="card-img-overlay">
                                <h5 className="card-title">{p.title}</h5>
                                <p className="card-text">
                                    Category:
                                    <ArticleTag tags={p.tags} />

                                </p>
                            </div>
                        </a>
                    </div>
                    
                )); 
            }
        }
        class Panel extends React.Component{
            constructor(props) {
                super(props);
                this.originalPosts={!! json_encode($posts->toArray()) !!}
                this.state={
                    posts:this.originalPosts,
                    tags:{!! json_encode($tags->toArray()) !!}
                }
                
                this.setFilterHandler = (e) => (
                        this.setState({
                            posts: e == 0 ? this.originalPosts : this.originalPosts.filter(p=>p.tags.find(t=>t.id == e))
                        })

                    
                    
                ); 
            }
            componentDidMount() {
                this.state.tags.unshift({id:0,name:"All"})
                this.setState({
                    tags:this.state.tags
                })
            }
            render(){
                return (
                    <div>
                        <p>Filter:</p>
                        <div id="filters">
                            <TagFilter setFilter={this.setFilterHandler} tags={this.state.tags} />
                        </div>
                        <p>Articles:</p>
                        <div id="articleList">
                            <ArticleList posts={this.state.posts} />
                        </div>
                    </div>
                )
            }
        }
        ReactDOM.render(
            <Panel />,document.getElementById('panel')
            
        );
    </script>
@endsection