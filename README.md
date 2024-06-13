

# PHPUnit Tests cho Project Quản Lý Kho Hàng

## Giới thiệu
Dự án này sử dụng PHPUnit để thực hiện kiểm thử tự động cho các chức năng quản lý sản phẩm trong hệ thống quản lý kho hàng. Các test case được thiết kế để đảm bảo tính chính xác và độ tin cậy của các thao tác cơ bản như thêm, sửa, và xóa sản phẩm.

## Cấu trúc Test
Dự án bao gồm ba tệp test chính:
1. DangKyTest.php: Kiểm tra chức năng đăng ký người dùng.
2. DangNhapTest.php: Kiểm tra chức năng đăng nhập.
3. SuaSanPhamTest.php: Kiểm tra chức năng sửa thông tin sản phẩm.
4. ThemSanPhamTest.php: Kiểm tra chức năng thêm sản phẩm mới.
5. XoaSanPhamTest.php: Kiểm tra chức năng xóa sản phẩm.
6. TimKiemSpTest.php: Kiểm tra chức năng tìm kiếm sản phẩm.
7. NhapKhoTest.php: Kiểm tra chức năng nhập kho.
8. XuatKhoTest.php: Kiểm tra chức năng xuất kho.

## Độ phủ Test
### DangKyTest
`DangKyTest` tập trung vào việc kiểm tra chức năng đăng ký người dùng. Nó bao gồm hai test case:
1. `testRegisterUserWithValidData`: Kiểm tra đăng ký thành công với dữ liệu hợp lệ.
2. `testRegisterUserWithInvalidData`: Kiểm tra đăng ký thất bại khi dữ liệu không hợp lệ.
Đánh giá:
- Độ phủ cơ bản: Test case kiểm tra cả trường hợp thành công và thất bại.
- Cần cải thiện: 
  - Thêm test case cho các trường hợp biên khác (ví dụ: mật khẩu quá ngắn, số điện thoại không hợp lệ).
  - Kiểm tra xử lý lỗi khi kết nối cơ sở dữ liệu thất bại.
  - Kiểm tra xử lý khi tài khoản đã tồn tại.

### DangNhapTest
`DangNhapTest` kiểm tra chức năng đăng nhập với bốn test case:
1. `testValidLogin`: Đăng nhập thành công với tên người dùng và mật khẩu đúng.
2. `testInvalidPassword`: Đăng nhập thất bại khi mật khẩu sai.
3. `testInvalidUsername`: Đăng nhập thất bại khi tên người dùng sai.
4. `testInvalidCredentials`: Đăng nhập thất bại khi cả tên người dùng và mật khẩu đều sai.
### SuaSanPhamTest
- Kiểm tra việc cập nhật thành công thông tin của một sản phẩm.
- Xác minh rằng tất cả các trường thông tin sản phẩm được cập nhật chính xác trong cơ sở dữ liệu.
- Độ phủ: Kiểm tra đầy đủ quá trình cập nhật, bao gồm kết nối cơ sở dữ liệu, thực hiện truy vấn, và xác minh kết quả.

### ThemSanPhamTest
- Kiểm tra việc thêm một sản phẩm mới vào cơ sở dữ liệu.
- Xác nhận rằng sản phẩm đã được thêm thành công bằng cách truy vấn lại cơ sở dữ liệu.
- Độ phủ: Bao gồm quá trình thêm sản phẩm và xác minh kết quả, nhưng chưa kiểm tra các trường hợp lỗi hoặc dữ liệu không hợp lệ.

### XoaSanPhamTest
- Kiểm tra việc xóa một sản phẩm khỏi cơ sở dữ liệu.
- Bao gồm cả trường hợp xóa thành công và trường hợp xóa không thành công (khi ID sản phẩm không tồn tại).
- Độ phủ: Kiểm tra cả hai kịch bản xóa thành công và không thành công, đảm bảo tính toàn vẹn của dữ liệu.


### TimKiemSpTest.php
- Tìm kiếm sản phẩm theo tên.
- Tìm kiếm sản phẩm theo loại.
- Tìm kiếm sản phẩm theo nhà cung cấp.
- Tìm kiếm sản phẩm theo ngày nhập.
- Tìm kiếm với chuỗi không tồn tại.
Độ phủ: Test này bao quát đầy đủ các trường hợp tìm kiếm sản phẩm, bao gồm cả trường hợp không tìm thấy kết quả.

### NhapKhoTest.php
- Kiểm tra việc thêm phiếu nhập với dữ liệu hợp lệ.
- Kiểm tra việc thêm phiếu nhập với số lượng âm (trường hợp không hợp lệ).
Độ phủ: Test này kiểm tra cả trường hợp thành công và thất bại của chức năng nhập kho, bao gồm việc cập nhật số lượng tồn kho.

### XuatKhoTest.php
- Kiểm tra việc thêm phiếu xuất với dữ liệu hợp lệ.
- Kiểm tra việc thêm phiếu xuất với số lượng âm (trường hợp không hợp lệ).
Độ phủ: Test này kiểm tra cả trường hợp thành công và thất bại của chức năng xuất kho.

## Đánh giá Độ phủ Tổng thể
- Bao quát các trường hợp sử dụng chính: nhập kho, xuất kho, và tìm kiếm sản phẩm.
- Kiểm tra cả trường hợp dữ liệu hợp lệ và không hợp lệ.
- Tích hợp với cơ sở dữ liệu để đảm bảo tính nhất quán của dữ liệu.
- Các test case hiện tại tập trung vào các chức năng cơ bản của quản lý sản phẩm.
- Mỗi thao tác (thêm, sửa, xóa) đều được kiểm tra về tính chính xác và hiệu quả.
- Tuy nhiên, vẫn còn thiếu các test case cho các trường hợp biên, dữ liệu không hợp lệ, và xử lý lỗi.


