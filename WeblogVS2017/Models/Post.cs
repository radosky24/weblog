using System;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace WeblogVS2017.Models
{
    [Table("posts")]
    public class Post
    {
        [Key]
        public int Id { get; set; }

        [Required]
        [StringLength(255)]
        [Column("title")]
        public string Title { get; set; }

        [Required]
        [StringLength(255)]
        [Column("slug")]
        public string Slug { get; set; }

        [Column("excerpt")]
        public string Summary { get; set; }

        [Column("content")]
        public string Content { get; set; }

        [StringLength(255)]
        [Column("thumbnail")]
        public string ImageUrl { get; set; }

        [Column("author_id")]
        public int AuthorId { get; set; }

        [ForeignKey("AuthorId")]
        public virtual User Author { get; set; }

        [Column("created_at")]
        public DateTime CreatedAt { get; set; } = DateTime.Now;

        [Column("updated_at")]
        public DateTime UpdatedAt { get; set; } = DateTime.Now;
    }
}
