using Microsoft.EntityFrameworkCore.Migrations;

namespace GiftWebApp.Data.Migrations
{
    public partial class setup3 : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<int>(
                name: "ItemId",
                table: "GiftShop",
                nullable: false,
                defaultValue: 0);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "ItemId",
                table: "GiftShop");
        }
    }
}
